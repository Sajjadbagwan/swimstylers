<?php

namespace Swim\Shipping\Carriers;

use Config;
use Swim\Checkout\Models\CartShippingRate;
use Swim\Shipping\Facades\Shipping;
use Swim\Checkout\Facades\Cart;

/**
 * Class Rate.
 *
 */
class FlatRate extends AbstractShipping
{
    /**
     * Payment method code
     *
     * @var string
     */
    protected $code  = 'flatrate';

    /**
     * Returns rate for flatrate
     *
     * @return array
     */
    public function calculate()
    {
        if (! $this->isAvailable())
            return false;

        $cart = Cart::getCart();

        $object = new CartShippingRate;

        $object->carrier = 'flatrate';
        $object->carrier_title = $this->getConfigData('title');
        $object->method = 'flatrate_flatrate';
        $object->method_title = $this->getConfigData('title');
        $object->method_description = $this->getConfigData('description');
        $object->price = 0;
        $object->base_price = 0;

        if ($this->getConfigData('type') == 'per_unit') {
            foreach ($cart->items as $item) {
                if($item['product_type'] != "class"){
                if ($item->product->getTypeInstance()->isStockable()) {
                    $object->price += core()->convertPrice($this->getConfigData('default_rate')) * $item->quantity;
                    $object->base_price += $this->getConfigData('default_rate') * $item->quantity;
                }
            }
            }
        } else {
            $object->price = core()->convertPrice($this->getConfigData('default_rate'));
            $object->base_price = $this->getConfigData('default_rate');
        }

        return $object;
    }
}