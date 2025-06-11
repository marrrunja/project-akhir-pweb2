<?php

namespace Tests\Feature\Produk;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProdukControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function testRedirectWithoutSession(): void
    // {
    //     $response = $this->withSession(['username' => 'Muammar'])->get('/produk/index');
    //     $response->assertStatus(200);
    //     $response->assertSeeText("Makanan");
    // }
    // public function testAdd(): void
    // {
    //     Storage::fake('local');

    //     $file = UploadedFile::fake()->create('testfile.jpg', 100); // 100 KB
    //     $this->withSession(['usename' => 'PEOPLE +62', 'user_id' => '1'])
    //         ->post('/produk/add', [
    //             'namaProduk' => 'tongseng',
    //             'kategori' => 1,
    //             'deskripsi' => 'Tongseng enak bgt',
    //             'foto' => $file,
    //             'variant' => ['pedas'],
    //             'stok' => [20],
    //             'harga' => [4000]
    //         ])->assertStatus(302)
    //         ->assertSessionHas(['status' => 'Berhasil menambah produk baru!!']);
    // }

    public function testGetProdukByIdModal():void
    {
        $this->withSession(['username' => 'Muammar', 'password' => 'irfan321'])
            ->get('/produk/detail/modal')
            ->assertSeeText("Hello");
    }
}
