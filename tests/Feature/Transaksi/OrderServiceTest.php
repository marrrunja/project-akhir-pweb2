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
    public function testOrderFailed():void{
        $error = null;
        self::assertFalse($this->orderService->addOrder([], $error));
        self::assertEquals("Data tidak boleh kosong", $error);
    }
    // public function testOrderSuccess():void
    // {
    //      $data = [
    //         'userId' => '4',
    //         'jumlah' => 1,
    //         'hargaSatuan' =>  16000,
    //         'totalHarga' => 16000,
    //         'variantId' => 33,
    //         'username' => 'Yoshioka_321'
    //     ];
    //     $error = null;
    //     $linkBayar = null;
    //     self::assertTrue($this->orderService->addOrder($data, $error, $linkBayar));
    // }
    public function testAddOrderFailNotFoundVariant():void{
         $data = [
            'userId' => '4',
            'jumlah' => 1,
            'hargaSatuan' =>  10000,
            'totalHarga' => 10000,
            'variantId' => 1000,
            'username' => 'Yoshioka_321'
        ];
        $error = null;
        $linkBayar = null;
        self::assertFalse($this->orderService->addOrder($data, $error, $linkBayar));
        self::assertEquals("Variant tidak ditemukan", $error);
    }
    // public function testAddOrdersSuccess():void
    // {
    //     $data = [
    //         'userId' => 4,
    //         'totalHarga' => 13000
    //     ];
    //     $error = null;
    //    self::assertTrue($this->orderService->addOrders($data, $error));
    // }
    public function testAddOrdersFailedEmptyData():void
    {
        $data = [];
        $error = null;
        self::assertFalse($this->orderService->addOrders($data, $error));
    }
    public function testAddOrdersFailedWithException():void
    {
        $data = [
            'userId' => 90,
            'totalHarga' => 1
        ];
        $error = null;
        self::assertFalse($this->orderService->addOrders($data, $error));
    }
}
