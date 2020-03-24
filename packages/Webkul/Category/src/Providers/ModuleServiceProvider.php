<?php

namespace Swim\Category\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Swim\Category\Models\Category::class,
        \Swim\Category\Models\CategoryTranslation::class,
    ];
}