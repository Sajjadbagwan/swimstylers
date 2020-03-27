<?php

namespace Swim\Tax\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Swim\Tax\Models\TaxCategory::class,
        \Swim\Tax\Models\TaxMap::class,
        \Swim\Tax\Models\TaxRate::class,
    ];
}