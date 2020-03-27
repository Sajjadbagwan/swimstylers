<?php

namespace Webkul\Masters\Providers;

use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Support\ServiceProvider;

class MastersServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
       // include __DIR__ . '/../Http/routes.php';
    }

    /**
     * Register services.
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function register()
    {
       $this->registerEloquentFactoriesFrom(__DIR__ . '/../Database/Factories');

        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/system.php', 'core'
        );
    }

    /**
     * Register factories.
     *
     * @param string $path
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function registerEloquentFactoriesFrom($path): void
    {
       // $this->app->make(EloquentFactory::class)->load($path);
    }
}