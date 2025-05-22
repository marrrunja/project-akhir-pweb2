<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Transaksi\OrderService;
use App\Services\Transaksi\OrderItemService;
use Illuminate\Contracts\Support\DeferrableProvider;
class TransakiServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->singleton(OrderService::class, function ($app) {
            return new OrderService($app->make(OrderItemService::class));
        });
        $this->app->singleton(OrderItemService::class, function ($app) {
            return new OrderItemService();
        });

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
    public function provides(): array
    {
        return [OrderService::class, OrderItem::class];
    }
}
