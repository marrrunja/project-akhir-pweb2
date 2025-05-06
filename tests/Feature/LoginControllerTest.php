<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\LoginService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

class LoginControllerTest extends TestCase
{
    // use WithoutMiddleware; // ⬅️ Tambahkan ini
    private LoginService $loginService;
    protected function setUp():void{
        parent::setUp();
        $this->loginService = $this->app->make(LoginService::class);
    }
    public function testSingleton(): void
    {
        $login1 = $this->app->make(LoginService::class);
        $login2 = $this->app->make(LoginService::class);
        self::assertSame($login1, $login2);
    }
    public function testViewLogin(){
        $this->get('/login/index')
            ->assertStatus(200)
            ->assertSeeText("Login");
    }
    public function testLogin()
    {
        $login = $this->app->make(LoginService::class);
        $error = null;
        self::assertTrue($login->login("Muammar", "123", $error));
    }
    public function testLoginWithWrongUsername():void
    {
        $this->post('/login/index/post',[
            'username' => 'gff',
            'password' => 'fdffdf'
        ])
            ->assertRedirect()
            ->assertSessionHas('status', 'Username tidak valid');
    }
    public function testLoginWithWrongPassword():void
    {
        $this->post('/login/index/post',[
            'username' => 'Muammar',
            'password' => 'fdf'
        ])
            ->assertRedirect('/')
            ->assertSessionHas('status', 'Password salah');   
    }
    public function testLoginSuccess():void
    {
        $this->post('/login/index/post',[
            'username' => 'Muammar',
            'password' => '123'
        ])
            ->assertRedirect('/')
            ->assertSessionHas('status', 'Login Berhasil');

    }
    
    
}
