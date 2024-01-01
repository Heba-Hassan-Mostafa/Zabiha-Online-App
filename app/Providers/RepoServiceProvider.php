<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            'App\Repositories\Cart\CartRepositoryInterface',
            'App\Repositories\Cart\CartRepository',
    
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
