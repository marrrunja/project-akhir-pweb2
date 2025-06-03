<?php

namespace Tests\Feature\Produk;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\Produk\ProdukVariantService;
class ProdukVariantServiceTest extends TestCase
{
    private ProdukVariantService $produkVariantService;

    protected function setUp():void
    {
        parent::setUp();
        $this->produkVariantService = $this->app->make(ProdukVariantService::class);
    }
    public function testNotNull(): void
    {
        self::assertNotNull($this->produkVariantService);
    }
    public function testSingleton():void
    {
        $produkVariantService = $this->app->make(ProdukVariantService::class);

        self::assertSame($this->produkVariantService, $produkVariantService);
    }
}
