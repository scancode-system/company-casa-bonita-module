<?php

namespace Modules\CompanyCasaBonita\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class CompanyCasaBonitaServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(module_path('CompanyCasaBonita', 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('CompanyCasaBonita', 'Config/config.php') => config_path('companycasabonita.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('CompanyCasaBonita', 'Config/config.php'), 'companycasabonita'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/companycasabonita');

        $sourcePath = module_path('CompanyCasaBonita', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/companycasabonita';
        }, \Config::get('view.paths')), [$sourcePath]), 'companycasabonita');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/companycasabonita');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'companycasabonita');
        } else {
            $this->loadTranslationsFrom(module_path('CompanyCasaBonita', 'Resources/lang'), 'companycasabonita');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path('CompanyCasaBonita', 'Database/factories'));
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
