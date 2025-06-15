<?php
namespace App\Providers;

use App\Services\UserService;
use App\Services\AdminService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class UserServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->singleton(UserService::class, function ($app) {
            return new UserService();
        });
        $this->app->singleton(AdminService::class, function ($app) {
            return new AdminService();
        });
    }
    /**
     * Get the services provided by the provider.
     *
     * @return array<int, string>
     */
    public function provides(): array
    {
        return [UserService::class, AdminService::class];
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
