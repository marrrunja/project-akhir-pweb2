<?php

namespace Tests\Feature\Cart;

use Tests\TestCase;
use App\Services\Cart\CartService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartServiceTest extends TestCase
{
    private CartService $cartService;

    protected function setUp():void
    {
        parent::setUp();
        $this->cartService = $this->app->make(CartService::class);
    }
    public function testNotNull(): void
    {
        self::assertNotNull($this->cartService);
    }
    public function testSingleton():void
    {
        $cartService = $this->app->make(CartService::class);
        self::assertSame($this->cartService, $cartService);
    }
    // public function testAdd():void{
    //     $error = null;
    //     self::assertTrue($this->cartService->addToCart(2, 1, 1, $error));
    // }
}
