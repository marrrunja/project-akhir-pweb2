<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\AdminService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminServiceTest extends TestCase
{
    private AdminService $adminService;
    protected function setUp():void
    {
        parent::setUp();
        $this->adminService = $this->app->make(AdminService::class);
    }
    public function testNotNull(): void
    {
        self::assertNotNull($this->adminService);
    }
    public function testSingleton()
    {
        $adminService = $this->app->make(AdminService::class);
        self::assertSame($adminService, $this->adminService);
    }
    public function testLoginWithWrongUsername():void
    {
        $data = [
            'username' => 'muammar',
            'password' => 'ssfsfdsf'
        ];
        $username = null;
        $error = null;
        self::assertFalse($this->adminService->login($data, $error, $username));
        self::assertEquals("Username atau password salah", $error);
    }
    public function testLoginWithWrongPassword():void
    {
        $data = [
            'username' => 'muammar123',
            'password' => 'ssfsfdsf'
        ];
        $username = null;
        $error = null;
        self::assertFalse($this->adminService->login($data, $error, $username));
        self::assertEquals("Username atau password salah", $error);
    }
    public function testLoginSuccess():void
    { 
           $data = [
            'username' => 'muammar123',
            'password' => 'irfan123'
        ];
        $username = null;
        $error = null;
        self::assertTrue($this->adminService->login($data, $error, $username));
        self::assertEquals(null, $error);
        self::assertEquals('muammar123', $username);
    }
}
