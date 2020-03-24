<?php

namespace Swim\CartRule\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen('checkout.order.save.after', 'Swim\CartRule\Listeners\Order@manageCartRule');

        Event::listen('checkout.cart.collect.totals.before', 'Swim\CartRule\Listeners\Cart@applyCartRules');
    }
}