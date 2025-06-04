<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testIndexWithoutSession(): void
    {
        $this->get('/produk/index')->assertRedirect('/login/index');
    }
    public function testIndexWithSession(): void
    {
        $this->withSession(['user_id' => '1', 'username' => 'Muammar'])
            ->get('/produk/index')
            ->assertSeeText("Daftar produk yang tersedia");
    }
}
