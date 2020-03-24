<?php

namespace Swim\Inventory\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Swim\Inventory\Models\InventorySource::class,
    ];
}