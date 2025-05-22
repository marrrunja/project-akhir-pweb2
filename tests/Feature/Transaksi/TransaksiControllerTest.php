<?php

namespace Tests\Feature\Transaksi;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransaksiControllerTest extends TestCase
{
    public function testKirimData(): void
    {
        $response = $this->post('/transaksi/checkout', [
            'jumlah' => 1,
            'totalHarga' => 15000,
            'id' => 2
        ]);
        $response->assertStatus(200);
    }
}
