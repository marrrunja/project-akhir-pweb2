<?php

namespace App\Providers;

use App\Services\LoginService;
use Illuminate\Support\ServiceProvider;

class LoginServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(LoginService::class, function ($app) {
            return new LoginService();
        });        
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
