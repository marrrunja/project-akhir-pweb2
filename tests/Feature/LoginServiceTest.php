<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\LoginService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginServiceTest extends TestCase
{
    private LoginService $loginService;

    protected function setUp():void{
        parent::setUp();
        $this->loginService = $this->app->make(LoginService::class);
    }
    public function testNotNull(): void
    {
        self::assertNotNull($this->loginService);
    }
    public function testSingleton():void
    {
        $loginService2 = $this->app->make(LoginService::class);
        self::assertSame($this->loginService, $loginService2);
    }
    public function testLoginFailedWithNoUser():void
    {
        $error = null;
        $id = null;
        $data = [
            'username' => 'Apaaja',
            'password' => 'nofodfdf'
        ];
        self::assertFalse($this->loginService->login($data,$id, $error));
        self::assertEquals('Username atau Password salah', $error);
    }
    public function testLoginFailedWithWrongPassword():void
    {
        $error = null;
        $id = null;
        $data = [
            'username' => 'Muammar',
            'password' => 'nofofdf'
        ];
        self::assertFalse($this->loginService->login($data,$id, $error));
        self::assertEquals('Username atau Password salah', $error);
    }
    public function testLoginSuccess():void
    {
        $error = null;
        $id = null;
        $data = [
            'username' => 'Muammar',
            'password' => 'irfan321'
        ];
        self::assertTrue($this->loginService->login($data,$id, $error));
        self::assertEquals(null, $error);
    }
    
}
