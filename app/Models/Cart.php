<?php
namespace App\Models;

use App\Models\Pembeli;
use App\Models\Produk\ProdukVariant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        $carts = Cart::with(['variant.produk'])
            ->where('pembeli_id', $id)
            ->get();
        return $carts;
    }
}
