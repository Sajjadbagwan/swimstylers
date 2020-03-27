<?php

namespace Swim\CMS\Providers;

use Illuminate\Support\ServiceProvider;
use Swim\CMS\Providers\ModuleServiceProvider;

class CMSServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}