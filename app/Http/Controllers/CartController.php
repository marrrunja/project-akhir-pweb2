<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Services\Cart\CartService;
class CartController extends Controller
{
    private CartService $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
    public function store(Request $request)
    {
        $request->validate([
            'variant_id' => 'required|exists:variants_id',
            'qty' => 'required|integer|min:1',
        ]);
        $userId = $request->session()->get('user_id');
        $variantId = $request->variantId;
        $qty = $request->qty;
        $error = null;
        
       if($this->cartService->addToCart($userId, $variantId, $qty, $error)){
        Cart::insert([
            'pembeli_id' => $userId,
            'variant_id' => $variantId,
            'qrt' =>  $qty
        ]);
        return redirect('/')->with('status', 'Berhasil menambah ke keranjang');
       }
       return redirect('');

    }

    public function index(Request $request) 
    {
        $cartItems = Cart::with('variant')->where('pembeli_id',$request->session()->get('user_id'))->firstOrFail();
        return view('cart.index', compact('cartItems'));
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::where('id', $id)->where('pembeli_id', $request->session()->get('user_id'))->firstOrFail();
        $cart->update(['qty' => $request->qty]);

        return redirect()->route('cart.index');
    }

    public function destroy($id)
    {
        $cart = Cart::where('id', $id)->where('pembeli_id', $request->session()->get('user_id'))->firstOrFail();
        $cart->delete();

        return redirect()->route('cart.index');
    }
}
