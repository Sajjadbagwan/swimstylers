<?php

namespace Swim\Checkout\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Swim\Checkout\Models\Cart::class,
        \Swim\Checkout\Models\CartAddress::class,
        \Swim\Checkout\Models\CartItem::class,
        \Swim\Checkout\Models\CartPayment::class,
        \Swim\Checkout\Models\CartShippingRate::class,
    ];
}