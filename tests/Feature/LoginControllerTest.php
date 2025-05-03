<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\LoginService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

class LoginControllerTest extends TestCase
{
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
            ->assertSeeText("Halaman Login");
    }
    public function testLogin()
    {
        $login = $this->app->make(LoginService::class);
        $error = null;
        self::assertTrue($login->login("Muammar", "123", $error));
    }
    
}
