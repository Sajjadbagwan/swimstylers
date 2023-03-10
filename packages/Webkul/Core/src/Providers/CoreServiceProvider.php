<?php

namespace Swim\Core\Providers;

use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\AliasLoader;
use Swim\Core\Core;
use Swim\Core\Facades\Core as CoreFacade;
use Swim\Core\Models\SliderProxy;
use Swim\Core\Observers\SliderObserver;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__ . '/../Http/helpers.php';

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        $this->registerEloquentFactoriesFrom(__DIR__ . '/../Database/Factories');

        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'core');

        Validator::extend('slug', 'Swim\Core\Contracts\Validations\Slug@passes');

        Validator::extend('code', 'Swim\Core\Contracts\Validations\Code@passes');

        Validator::extend('decimal', 'Swim\Core\Contracts\Validations\Decimal@passes');

        $this->publishes([
            dirname(__DIR__) . '/Config/concord.php' => config_path('concord.php'),
        ]);

        SliderProxy::observe(SliderObserver::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFacades();
    }

    /**
     * Register Bouncer as a singleton.
     *
     * @return void
     */
    protected function registerFacades()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('core', CoreFacade::class);

        $this->app->singleton('core', function () {
            return app()->make(Core::class);
        });
    }

    /**
     * Register factories.
     *
     * @param string $path
     *
     * @return void
     */
    protected function registerEloquentFactoriesFrom($path): void
    {
        $this->app->make(EloquentFactory::class)->load($path);
    }
}
