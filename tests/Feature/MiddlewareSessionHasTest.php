<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MiddlewareSessionHasTest extends TestCase
{
    public function testRedirectLogin(): void
    {
        $response = $this->withSession(['username' => 'Muammmar'])->get('/login/index');
        $response->assertRedirect('/');
    }
    public function testRedirectRegister(): void
    {
        $response = $this->withSession(['username' => 'Muammmar'])->get('/register/index');
        $response->assertRedirect('/');
    }
}
