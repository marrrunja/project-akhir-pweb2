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
    // public function testDoLoginSuccess():void
    // {
    //     $data = [
    //         'username' => 'muammar123',
    //         'password' => 'irfan123'
    //     ];
    //     $this->post('/admin/login', $data)
    //          ->assertRedirect('/admin/index')
    //          ->assertSessionHas(['admin' => 'muammar123']);
    // }
    // public function testDoLoginFailedWrongUsername():void
    // {
    //     $data = [
    //         'username' => 'muammar1',
    //         'password' => 'irfan123'
    //     ];
    //     $this->post('/admin/login', $data)
    //          ->assertRedirect()
    //          ->assertSessionHas(['status' => 'Username atau password salah']);
    // }
    // public function testDoLoginFailedWrongPassword():void
    // {
    //     $data = [
    //         'username' => 'muammar1123',
    //         'password' => 'irfan'
    //     ];
    //     $this->post('/admin/login', $data)
    //          ->assertRedirect()
    //          ->assertSessionHas(['status' => 'Username atau password salah']);
    // }
    public function testWithMiddlewareAdmin():void
    {
        $this->withSession(['admin' => 'muammar123'])
                ->get('/admin/login')->assertRedirect("/admin/index");
    }
    public function testWithMiddlewareAdminLogout():void
    {
        $this->withSession(['admin' => 'muammar123'])
                ->post('/admin/logout',[])
                ->assertJson(['redirect_url' => '/admin/login'])
                ->assertSessionMissing('admin');
    }
}
