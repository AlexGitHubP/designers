<?php

namespace Locomotif\Designers;

use Illuminate\Support\ServiceProvider;

class DesignersServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Locomotif\Designers\Controller\DesignerController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/Routes/routes.php');
        $this->loadViewsFrom(__DIR__.'/views', 'designers');

        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');

        $this->publishes([
            __DIR__.'/views' => resource_path('views/locomotif/designers'),
        ]);
        
    }
}
