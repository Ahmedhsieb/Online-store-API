<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            'App\Http\Interfaces\AuthInterface',
            'App\Http\Repositories\AuthRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\ProductInterface',
            'App\Http\Repositories\ProductRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\CartInterface',
            'App\Http\Repositories\CartRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\OrderInterface',
            'App\Http\Repositories\OrderRepository'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
