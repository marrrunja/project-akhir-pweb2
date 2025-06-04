<?php

namespace Tests\Feature\Transaksi;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
class TransaksiControllerTest extends TestCase
{
  
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

    public function testAddOrder():void
    {
        $response = $this->withSession(['user_id' => 1, 'username' => 'Muammar']);
        
    }


}
