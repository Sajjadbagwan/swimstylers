<?php

namespace Swim\Velocity\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Swim\Velocity\Models\Content::class,
        \Swim\Velocity\Models\Category::class
    ];
}