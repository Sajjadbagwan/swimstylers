<?php

namespace Swim\Paypal\Http\Controllers;

use Swim\Checkout\Facades\Cart;
use Swim\Sales\Repositories\OrderRepository;
use Swim\Paypal\Helpers\Ipn;

/**
 * Paypal Standard controller
 *
 * @author    Jitendra Singh <jitendra@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class StandardController extends Controller
{
    /**
     * OrderRepository object
     *
     * @var array
     */
    protected $orderRepository;

    /**
     * Ipn object
     *
     * @var array
     */
    protected $ipnHelper;

    /**
     * Create a new controller instance.
     *
     * @param  \Swim\Attribute\Repositories\OrderRepository  $orderRepository
     * @return void
     */
    public function __construct(
        OrderRepository $orderRepository,
        Ipn $ipnHelper
    )
    {
        $this->orderRepository = $orderRepository;

        $this->ipnHelper = $ipnHelper;
    }

    /**
     * Redirects to the paypal.
     *
     * @return \Illuminate\View\View
     */
    public function redirect()
    {
        return view('paypal::standard-redirect');
    }

    /**
     * Cancel payment from paypal.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        session()->flash('error', 'Paypal payment has been canceled.');

        return redirect()->route('shop.checkout.cart.index');
    }

    /**
     * Success payment
     *
     * @return \Illuminate\Http\Response
     */
    public function success()
    {
        $order = $this->orderRepository->create(Cart::prepareDataForOrder());

        Cart::deActivateCart();

        session()->flash('order', $order);

        return redirect()->route('shop.checkout.success');
    }

    /**
     * Paypal Ipn listener
     *
     * @return \Illuminate\Http\Response
     */
    public function ipn()
    {
        $this->ipnHelper->processIpn(request()->all());
    }
}