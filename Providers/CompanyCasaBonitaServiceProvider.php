<?php

namespace Modules\CompanyCasaBonita\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Modules\Order\Entities\Order;
use Modules\CompanyCasaBonita\Entities\CasaBonitaOrder;

class CompanyCasaBonitaServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerViews();
        $this->loadMigrationsFrom(module_path('CompanyCasaBonita', 'Database/Migrations'));


        Order::addDynamicRelation('casa_bonita_order', function (Order $order) {
            return $order->hasOne(CasaBonitaOrder::class);
        });
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
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
