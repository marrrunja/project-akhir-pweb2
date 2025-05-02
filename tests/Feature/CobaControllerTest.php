<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CobaControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testView()
    {
        $this->get('/form/index')
            ->assertStatus(200)
            ->assertSeeText("Form");
    }
    public function testMethodPost(): void
    {
        $this->post('/request/post',[
            'nama' => "Irfan",
            'nim' => "F1E123040",
            'tanggal_lahir' => "12-12-2000"
        ])
        ->assertSeeText("F1E123040")
        ->assertSeeText("Irfan")
        ->assertDontSeeText("12-12-2000");  
    }
    public function testRedirectPost():void 
    {
        $this->post('/request/post/redirect')->assertRedirect('/');
    }
}
