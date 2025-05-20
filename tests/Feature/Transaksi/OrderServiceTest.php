<?php

namespace Tests\Feature\Transaksi;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\Transaksi\OrderService;

class OrderServiceTest extends TestCase
{
    private OrderService $OrderService;
    protected function setUp():void
    {
        parent::setUp();
        $this->orderService = $this->app->make(OrderService::class);
    }

    public function testNotNull():void
    {
        self::assertNotNull($this->orderService);
    }
    public function testSingleton():void
    {
        $orderService = $this->app->make(OrderService::class);
        $orderService2 = $this->app->make(OrderService::class);
        self::assertSame($this->orderService, $orderService);
        self::assertSame($orderService2, $orderService);
    }
    public function testClosure():void
    {
        self::assertEquals($this->orderService->hello(), "Hello order service");
    }
}
