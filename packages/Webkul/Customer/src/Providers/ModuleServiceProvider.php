<?php

namespace Swim\Customer\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Swim\Customer\Models\Customer::class,
        \Swim\Customer\Models\CustomerAddress::class,
        \Swim\Customer\Models\CustomerGroup::class,
        \Swim\Customer\Models\Wishlist::class,
    ];
}