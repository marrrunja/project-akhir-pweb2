<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\UserService;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    protected function setUp():void{
        parent::setUp();
        $this->userService = $this->app->make(UserService::class);
    }
    public function testNotNull(): void
    {
        self::assertNotNull($this->userService);
    }
    public function testSingleton()
    {
        $userService2 = $this->app->make(UserService::class);
        $userService3 = $this->app->make(UserService::class);
        self::assertSame($userService2, $this->userService);
        self::assertSame($userService2, $userService3);
    }
    // public function testRegisterFailed():void
    // {
    //     $error = null;
    //     self::assertTrue($this->userService->register("Irfan", "Kosong", "gaada", "gaada", $error));
    //     self::assertEquals(null, $error);
    // }
    // public function testRegisterSuccess():void
    // {
    //     $error = null;
    //     self::assertTrue($this->userService->register("Hehe", "Kosong", "gaada", "gaada", $error));
    //     self::assertEquals(null, $error);
    // }
}
