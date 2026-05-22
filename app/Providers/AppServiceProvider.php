<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Interfaces\ProductoInterface::class, \App\DAO\ProductoDAO::class);
        $this->app->bind(\App\Interfaces\DashboardInterface::class, \App\DAO\DashboardDAO::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
