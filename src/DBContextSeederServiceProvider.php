<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder;

use Illuminate\Support\ServiceProvider;

class DBContextSeederServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('dbcontextseeder.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'dbcontextseeder');

        $this->app->singleton('dbcontextseeder', function () {
            return new DBContextSeeder;
        });
    }
}
