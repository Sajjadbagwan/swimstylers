<?php

namespace Swim\User\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Swim\User\Models\Admin::class,
        \Swim\User\Models\Role::class,
    ];
}