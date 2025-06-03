<?php

namespace App\Providers;

use App\Services\Produk\ProdukService;
use App\Services\Produk\ProdukVariantService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class ProdukServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->singleton(ProdukService::class, function ($app) {
            return new ProdukService();
        });
        $this->app->singleton(ProdukVariantService::class, function ($app) {
            return new ProdukVariantService();
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
