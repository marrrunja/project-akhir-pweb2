<?php

namespace Tests\Feature\Transaksi;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
class TransaksiControllerTest extends TestCase
{   
    public function testOrderFailed()
    {
        $this->withSession(['username' => 'Muammar', 'user_id' => 1])
            ->post('/transaksi/checkout', [
                []
            ])->assertStatus(302)
            ->assertRedirect();
    }
    public function testOrderFailedWithWrongVariantId():void
    {
        $this->withSession(['username' => 'Muammar', 'user_id' => 1])
            ->post('/transaksi/checkout',[
                'jumlah' => 10,
                'totalHarga' => 100000,
                'id' => 100000,
                'harga' => 10000
            ])->assertStatus(422)
            ->assertJson([
                'pesan' => 'Variant tidak ditemukan',
                'status' => 'gagal'
            ]);
    }
    public function testAccessDeniedNoSession():void
    {
        $this->post('/transaksi/checkout',[
                'jumlah' => 10,
                'totalHarga' => 100000,
                'id' => 100000,
                'harga' => 10000
            ])->assertStatus(302)
            ->assertRedirect('/login/index');
    }
    public function testAddFailedWithNoStok():void
    {
        $this->withSession(['username' => 'Muammar', 'user_id' => 1])
        ->post('/transaksi/checkout',[
            'jumlah' => 14,
            'totalHarga' => 84000,
            'id' => 1,
            'harga' => 6000
        ])->assertStatus(422)
        ->assertJson([
            'pesan' => 'Maaf stok tidak mencukupi sekarang',
            'status' => 'gagal'
        ]);
    }

    // udah berhasil, tapi harus dikomen, biar gak nambah terus di database
    // public function testAddSuccess():void
    // {
    //     $this->withSession(['username' => 'Muammar', 'user_id' => 1])
    //     ->post('/transaksi/checkout',[
    //         'jumlah' => 1,
    //         'totalHarga' => 6000,
    //         'id' => 1,
    //         'harga' => 6000
    //     ])->assertStatus(200)
    //     ->assertJson(['status' => 'berhasil']);
    // }
}
