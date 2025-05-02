<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    public function testRegister(): void
    {
        $response = $this->get('/register/index');
        $response->assertStatus(200);
        $response->assertSeeText('Halaman Register');
    }
    public function testRegisterSubmit():void
    {
        $this->post('/register/index')
            ->assertStatus(200)
            ->assertSeeText("Berhasil");
    }
}
