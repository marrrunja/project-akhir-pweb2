<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Services\Cart\CartService;
<<<<<<< HEAD
=======
use App\Models\Produk\ProdukVariant;

>>>>>>> a758bb279a1212d68fa4f2136208918ae1de4ab0
class CartController extends Controller
{
    public function cart(Request $request)
    {
        $carts = Cart::with(['variant.produk'])
                    ->where('pembeli_id',$request->session()->get('user_id'))
                    ->get();
        return view('cart.cart', compact('carts'));
    }
    private CartService $cartService;
    
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    //method masuk keranjang
    public function store(Request $request)
    {
        $request->validate([
            'variant_id' => 'required|exists:produk_variants,id',
            'qty' => 'required|integer|min:1',
        ]);

        $userId = $request->session()->get('user_id');
        if (!$userId) {
            return redirect()->back()->withErrors('User belum login');
        }

        $variantId = $request->variant_id;
        $qty = $request->qty;
        $error = null;
<<<<<<< HEAD
        
       if($this->cartService->addToCart($userId, $variantId, $qty, $error)){
        Cart::insert([
            'pembeli_id' => $userId,
            'variant_id' => $variantId,
            'qrt' =>  $qty
        ]);
        return redirect('/')->with('status', 'Berhasil menambah ke keranjang');
       }
       return redirect('');
=======

        // Cek stok produk variant
        $variant = ProdukVariant::with('stok')->find($variantId);
        $stokTersedia = $variant->stok ? $variant->stok->count() : 0;
>>>>>>> a758bb279a1212d68fa4f2136208918ae1de4ab0

        if ($stokTersedia < $qty) {
            return redirect()->back()->withErrors('Stok tidak mencukupi.');
        }

        // Kurangi stok sesuai qty
        $variant->stok()->limit($qty)->delete();

        //biar gak masuk keranjang 2 kali jadi updete qtynya aja
        if ($this->cartService->addToCart($userId, $variantId, $qty, $error)) {
   
            $cartItem = Cart::where('pembeli_id', $userId)
                            ->where('variant_id', $variantId)
                            ->first();

            if ($cartItem) {
                $cartItem->qty += $qty;
                $cartItem->save();
            } else {
                Cart::insert([
                    'pembeli_id' => $userId,
                    'variant_id' => $variantId,
                    'qty' => $qty,
                ]);
            }
        } else {
            return redirect()->back()->withErrors($error);
        }

        return redirect('cart');
    }




    // public function index(Request $request) 
    // {
    //     $cartItems = 
    //     return view('cart.index', compact('cartItems'));
    // }

    //method update jumlah di cart
    public function update(Request $request, $id)
    {
        $cart = Cart::where('id', $id)->where('pembeli_id', $request->session()->get('user_id'))->firstOrFail();
        $cart->update(['qty' => $request->qty]);

        return redirect('cart');
    }

    //method hapus hapus
    public function destroy(Request $request, $id)
    {
        $cart = Cart::where('id', $id)
                    ->where('pembeli_id', $request->session()->get('user_id'))
                    ->firstOrFail();

        // Kurangi qty sebanyak 1
        if ($cart->qty > 1) {
            $cart->qty -= 1;
            $cart->save();
        } else {
            // Jika qty sudah 1, hapus amar (eh maksudnya row)
            $cart->delete();
        }

        return redirect('cart');
    }

}
