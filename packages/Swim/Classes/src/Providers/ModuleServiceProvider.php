<?php

namespace Swim\Classes\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Swim\Classes\Models\Category::class,
        \Swim\Classes\Models\CategoryTranslation::class,
    ];
}