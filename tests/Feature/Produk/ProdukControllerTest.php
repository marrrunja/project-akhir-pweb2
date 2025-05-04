<?php

namespace Tests\Feature\Produk;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProdukControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testRedirectWithoutSession(): void
    {
        $response = $this->get('/produk/index');
        $response->assertStatus(200);
        $response->assertSeeText("Makanan");
    }
}
