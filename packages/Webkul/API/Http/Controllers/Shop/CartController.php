<?php

namespace Swim\API\Http\Controllers\Shop;

use Illuminate\Support\Facades\Event;
use Swim\Checkout\Repositories\CartRepository;
use Swim\Checkout\Repositories\CartItemRepository;
use Swim\API\Http\Resources\Checkout\Cart as CartResource;
use Cart;
use Swim\Customer\Repositories\WishlistRepository;

/**
 * Cart controller
 *
 * @author    Jitendra Singh <jitendra@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class CartController extends Controller
{
    /**
     * Contains current guard
     *
     * @var array
     */
    protected $guard;

    /**
     * CartRepository object
     *
     * @var Object
     */
    protected $cartRepository;

    /**
     * CartItemRepository object
     *
     * @var Object
     */
    protected $cartItemRepository;

    /**
     * WishlistRepository object
     *
     * @var Object
     */
    protected $wishlistRepository;

    /**
     * Controller instance
     *
     * @param Swim\Checkout\Repositories\CartRepository     $cartRepository
     * @param Swim\Checkout\Repositories\CartItemRepository $cartItemRepository
     * @param Swim\Checkout\Repositories\WishlistRepository $wishlistRepository
     */
    public function __construct(
        CartRepository $cartRepository,
        CartItemRepository $cartItemRepository,
        WishlistRepository $wishlistRepository
    )
    {
        $this->guard = request()->has('token') ? 'api' : 'customer';

        auth()->setDefaultDriver($this->guard);

        // $this->middleware('auth:' . $this->guard);

        $this->_config = request('_config');

        $this->cartRepository = $cartRepository;

        $this->cartItemRepository = $cartItemRepository;

        $this->wishlistRepository = $wishlistRepository;
    }

    /**
     * Get customer cart
     *
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        $customer = auth($this->guard)->user();

        $cart = Cart::getCart();

        return response()->json([
            'data' => $cart ? new CartResource($cart) : null
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        if (request()->get('is_buy_now')) {
            Event::dispatch('shop.item.buy-now', $id);
        }
        
        Event::dispatch('checkout.cart.item.add.before', $id);

        $result = Cart::addProduct($id, request()->except('_token'));

        if (! $result) {
            $message = session()->get('warning') ?? session()->get('error');

            return response()->json([
                    'error' => session()->get('warning')
                ], 400);
        }

        if ($customer = auth($this->guard)->user())
            $this->wishlistRepository->deleteWhere(['product_id' => $id, 'customer_id' => $customer->id]);

        Event::dispatch('checkout.cart.item.add.after', $result);

        Cart::collectTotals();

        $cart = Cart::getCart();

        return response()->json([
                'message' => 'Product added to cart successfully.',
                'data' => $cart ? new CartResource($cart) : null
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        foreach (request()->get('qty') as$qty) {
            if ($qty <= 0) {
                return response()->json([
                        'message' => trans('shop::app.checkout.cart.quantity.illegal')
                    ], 401);
            }
        }

        foreach (request()->get('qty') as $itemId => $qty) {
            $item = $this->cartItemRepository->findOneByField('id', $itemId);

            Event::dispatch('checkout.cart.item.update.before', $itemId);

            Cart::updateItems(request()->all());

            Event::dispatch('checkout.cart.item.update.after', $item);
        }

        Cart::collectTotals();

        $cart = Cart::getCart();

        return response()->json([
                'message' => 'Cart updated successfully.',
                'data' => $cart ? new CartResource($cart) : null
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        Event::dispatch('checkout.cart.delete.before');

        Cart::deActivateCart();

        Event::dispatch('checkout.cart.delete.after');

        $cart = Cart::getCart();

        return response()->json([
                'message' => 'Cart removed successfully.',
                'data' => $cart ? new CartResource($cart) : null
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyItem($id)
    {
        Event::dispatch('checkout.cart.item.delete.before', $id);

        Cart::removeItem($id);

        Event::dispatch('checkout.cart.item.delete.after', $id);

        Cart::collectTotals();

        $cart = Cart::getCart();

        return response()->json([
                'message' => 'Cart removed successfully.',
                'data' => $cart ? new CartResource($cart) : null
            ]);
    }

    /**
     * Function to move a already added product to wishlist
     * will run only on customer authentication.
     *
     * @param instance cartItem $id
     */
    public function moveToWishlist($id)
    {
        Event::dispatch('checkout.cart.item.move-to-wishlist.before', $id);

        Cart::moveToWishlist($id);

        Event::dispatch('checkout.cart.item.move-to-wishlist.after', $id);

        Cart::collectTotals();

        $cart = Cart::getCart();

        return response()->json([
                'message' => 'Cart item moved to wishlist successfully.',
                'data' => $cart ? new CartResource($cart) : null
            ]);
    }
}
