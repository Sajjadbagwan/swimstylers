<?php

namespace Webkul\Classes\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Webkul\Classes\Models\Category::class,
        \Webkul\Classes\Models\CategoryTranslation::class,
    ];
}