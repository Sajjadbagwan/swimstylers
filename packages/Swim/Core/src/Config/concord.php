<?php

return [
    'modules' => [
        /**
         * Example:
         * VendorA\ModuleX\Providers\ModuleServiceProvider::class,
         * VendorB\ModuleY\Providers\ModuleServiceProvider::class
         *
         */

        \Swim\Attribute\Providers\ModuleServiceProvider::class,
        \Swim\Category\Providers\ModuleServiceProvider::class,
        \Swim\Checkout\Providers\ModuleServiceProvider::class,
        \Swim\Core\Providers\ModuleServiceProvider::class,
        \Swim\Customer\Providers\ModuleServiceProvider::class,
        \Swim\Inventory\Providers\ModuleServiceProvider::class,
        \Swim\Product\Providers\ModuleServiceProvider::class,
        \Swim\Sales\Providers\ModuleServiceProvider::class,
        \Swim\Tax\Providers\ModuleServiceProvider::class,
        \Swim\User\Providers\ModuleServiceProvider::class,
        \Swim\CatalogRule\Providers\ModuleServiceProvider::class,
        \Swim\CartRule\Providers\ModuleServiceProvider::class,
        \Swim\CMS\Providers\ModuleServiceProvider::class
    ]
];