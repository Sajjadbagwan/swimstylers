<?php

namespace Swim\CatalogRule\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Swim\CatalogRule\Models\CatalogRule::class,
        \Swim\CatalogRule\Models\CatalogRuleProduct::class,
        \Swim\CatalogRule\Models\CatalogRuleProductPrice::class
    ];
}