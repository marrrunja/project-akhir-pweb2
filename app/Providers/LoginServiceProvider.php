<?php

namespace App\Providers;

use App\Services\LoginService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class LoginServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->singleton(LoginService::class, function ($app) {
            return new LoginService();
        });        
    }
    public function provides(): array
    {
        return [LoginService::class];
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
