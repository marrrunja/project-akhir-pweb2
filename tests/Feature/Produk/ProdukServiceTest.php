<?php

namespace Tests\Feature\Produk;

use Tests\TestCase;
use App\Services\Produk\ProdukService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProdukServiceTest extends TestCase
{
    private ProdukService $produkService;
    protected function setUp():void{
        parent::setUp();
        $this->produkService = $this->app->make(ProdukService::class);
    }
    public function testObjectNotNull(): void
    {
        self::assertNotNull($this->produkService);
    }
    public function testSingleton():void
    {
        $produkService = $this->app->make(ProdukService::class);
        self::assertSame($this->produkService, $produkService);
    }
}
