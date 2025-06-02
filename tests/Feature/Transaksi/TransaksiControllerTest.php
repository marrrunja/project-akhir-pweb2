<?php

namespace Tests\Feature\Transaksi;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\Transaksi\OrderService;
class TransaksiControllerTest extends TestCase
{
    private OrderService $OrderService;
    // berhasil ya
    // public function testKirimData(): void
    // {
    //     $response = $this->withSession(['username' => 'Muammar', 'user_id' => '1'])->post('/transaksi/checkout', [
    //        'jumlah' => 1,
    //        'totalHarga' => 5000,
    //        'id' => 29,
    //        'harga' => 5000
    //     ]);
    //     $response->assertStatus(200);
    // }

    public function testAddOrders():void
    {

    }


}
