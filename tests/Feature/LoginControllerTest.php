<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\LoginService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginControllerTest extends TestCase
{
    public function testSingleton(): void
    {
        $login1 = $this->app->make(LoginService::class);
        $login2 = $this->app->make(LoginService::class);
        self::assertSame($login1, $login2);
    }
    public function testLogin()
    {
        $login = $this->app->make(LoginService::class);
        self::assertTrue($login->login("Username", "Password"));
    }
    
}
