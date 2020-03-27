<?php

namespace Swim\Classes\Providers;

use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Support\ServiceProvider;
use Swim\Classes\Models\ClassesProxy;
use Swim\Classes\Observers\ClassesObserver;

class ClassesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        ClassesProxy::observe(ClassesObserver::class);

        $this->registerEloquentFactoriesFrom(__DIR__ . '/../Database/Factories');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
           /* $this->mergeConfigFrom(
        dirname(__DIR__) . '/Config/menu.php', 'menu.admin'
    );*/
    }

    /**
     * Register factories.
     *
     * @param  string  $path
     * @return void
     */
    protected function registerEloquentFactoriesFrom($path): void
    {
        $this->app->make(EloquentFactory::class)->load($path);
    }
}