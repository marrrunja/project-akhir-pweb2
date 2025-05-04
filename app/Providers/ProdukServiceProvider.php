<?php

namespace App\Providers;

use App\Services\Produk\ProdukService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class ProdukServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->singleton(ProdukService::class, function ($app) {
            return new ProdukService();
        }); 
    }
    public function provides(): array
    {
        return [ProdukService::class];
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
