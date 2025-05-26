<?php

namespace Tests\Feature\Transaksi;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\Transaksi\OrderItemService;
class OrderItemServiceTest extends TestCase
{
    private OrderItemService $orderItemService;
    protected function setUp():void
    {
        parent::setUp();
        $this->orderItemService = $this->app->make(OrderItemService::class);
    }
    public function testNotNull():void
    {
        self::assertNotNull($this->orderItemService);
    }
    public function testSingleton():void
    {
        $orderItemService = $this->app->make(OrderItemService::class);
        self::assertSame($this->orderItemService, $orderItemService);
    } 
}
