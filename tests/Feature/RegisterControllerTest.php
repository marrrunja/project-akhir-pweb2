<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;


class RegisterControllerTest extends TestCase
{
    //use WithoutMiddleware; // ⬅️ Tambahkan ini
    public function testRegister(): void
    {
        $response = $this->get('/register/index');
        $response->assertStatus(200);
        $response->assertSeeText('Halaman Register');
    }
    public function testRegisterSubmit():void
    {

        $response = $this->withoutMiddleware(VerifyCsrfToken::class)
                 ->post('/register/index', [
                     'username' => '',
                     'password' => '',
                     'kecamatan' => '',
                     'desa' => '',
                     'alamat' => ''
                 ]);

            $response->assertStatus(302); // redirect karena validasi gagal
            $response->assertSessionHasErrors(['desa']); // validasi error pada 'desa'

    }
}
