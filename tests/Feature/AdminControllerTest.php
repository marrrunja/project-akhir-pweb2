<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testView(): void
    {
        $response = $this->get('/admin/login');
        $response->assertSeeText('Admin Login');
    }
    // public function testDoLogin():void
    // {
    //     $data = [
    //         'username' => 'muammar123',
    //         'password' => 'irfan123'
    //     ];
    //     $this->post('/admin/login', $data)
    //          ->assertSeeText("Hello");

    // }
}
