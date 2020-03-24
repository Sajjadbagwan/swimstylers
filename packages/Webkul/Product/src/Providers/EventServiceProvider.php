<?php

namespace Swim\Product\Providers;

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
        Event::listen('catalog.attribute.create.after', 'Swim\Product\Listeners\ProductFlat@afterAttributeCreatedUpdated');

        Event::listen('catalog.attribute.update.after', 'Swim\Product\Listeners\ProductFlat@afterAttributeCreatedUpdated');

        Event::listen('catalog.attribute.delete.before', 'Swim\Product\Listeners\ProductFlat@afterAttributeDeleted');

        Event::listen('catalog.product.create.after', 'Swim\Product\Listeners\ProductFlat@afterProductCreatedUpdated');

        Event::listen('catalog.product.update.after', 'Swim\Product\Listeners\ProductFlat@afterProductCreatedUpdated');
    }
}