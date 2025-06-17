<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Produk\Stok;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\Cart\CartService;
use App\Models\Produk\ProdukVariant;

class CartController extends Controller
{
    private CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
    public function index()
    {
        $carts = Cart::all();

        return view('cart.index', compact('carts'));
    }
    public function cart(Request $request)
    {
        $carts = Cart::with(['variant.produk'])
            ->where('pembeli_id', $request->session()->get('user_id'))
            ->get();
        return view('cart.index', compact('carts'));
    }

    //method masuk keranjang
    public function store(Request $request):JsonResponse
    {
        $request->validate([
            'variant_id' => 'required|exists:produk_variants,id',
            'qty'        => 'required|integer|min:1',
        ]);

        $userId = $request->session()->get('user_id');
        if (! $userId) {
            return response()->json(['messsage' => 'Belum login']);
        }
        
        $variantId = $request->variant_id;
        $qty       = $request->qty;
        $error     = null;
        
        // Cek stok produk variant
        $variant      = ProdukVariant::with('stok')->find($variantId);
        $stokTersedia = $variant->stok ? $variant->stok->count() : 0;

        if ($stokTersedia < $qty) {
            return response()->json([
                "message" => "Stok tidak mencukupi"
            ]);
        }

        // Kurangi stok sesuai qty
        //$variant->stok()->limit($qty)->delete();

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
                    'qty'        => $qty,
                ]);
            }
            return response()->json(['message' => "Berhasil tambah ke cart"]);
        } else {
             return response()->json(['message' => "Gagal tambah ke cart"]);
        }
    }

    // method update jumlah di cart
    public function update(Request $request, $id)
    {
        $request->validate([
            'id'  => 'required|exists:carts,id',
            'qty' => 'required|integer|min:1',
        ]);

        $cart   = Cart::findOrFail($request->id);
        $newQty = max(1, min($request->qty, $cart->variant->stok->jumlah));

        $cart->qty = $newQty;
        $cart->save();

        return response()->json(['success' => true, 'qty' => $request->qty, 'id' => $request->id]);
    }

    //method hapus hapus
    public function destroy(Request $request): JsonResponse
    {
        $cartId = $request->id;
        $userId = $request->userId;
        $cart   = Cart::where('id', $cartId)
            ->where('pembeli_id', $userId);

        $data = [
            'cart_id' => $cartId,
            'user_id' => $userId,
        ];
        $cart->delete();
        return response()->json($data);
    }

    public function clearCart(Request $request): JsonResponse
    {
        $userId = $request->userId;
        Cart::where('pembeli_id', $userId)->delete();

        return response()->json(['success' => true]);
    }

    public function getStok(Request $request)
    {
        $id = $request->id;
        $userId = $request->session()->get('user_id');
        $stok = Cart::where('variant_id', $id)->where('pembeli_id', $userId)->first();
        $jumlah = Stok::where('variant_id', $id)->first();
        $data = [
            'stok' => $stok->qty,
            'jumlah' => $jumlah->jumlah
        ];
        return response()->json($data);
    }

}
