<?php
namespace App\Models;

use App\Models\Pembeli;
use Illuminate\Support\Facades\DB;
use App\Models\Produk\ProdukVariant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['pembeli_id', 'variant_id', 'qty'];
    protected $with = ['variant', 'pembeli'];
    // update, localhost/user/1{}
    public function variant()
    {
        return $this->belongsTo(ProdukVariant::class);
    }

    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class);
    }

    public static function getAllCartWithUserId($id)
    {
        $carts = Cart::with(['variant'])
            ->where('pembeli_id', $id)
            ->get();
        return $carts;
    }
    public static function getCountCartsByUserId($id)
    {
        $carts = DB::table('carts')->where('pembeli_id', '=', $id)->get();
        return count($carts);
    } 
      
    public static function getTotalCartByUserId($id=null)
    {
        $id = $id ?? auth()->id();
        if (!$id) {
        return 0; 
    }
       $carts = Cart::with(['variant'])
            ->where('pembeli_id', $id)
            ->get();

            
        $total = 0;
        foreach ($carts as $cart) {
            $total = $carts->sum(fn($cart) => ($cart->variant->harga ?? 0)* $cart->qty);
        }
        // dd($total);
        return $total;
    }

}
