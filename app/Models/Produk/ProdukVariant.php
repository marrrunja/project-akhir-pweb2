<?php
namespace App\Models\Produk;

use App\Models\Produk\Product;
use App\Models\Produk\Stok;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProdukVariant extends Model
{
    protected $table = 'produk_variants';
    protected $with  = ['produk'];
    public function produk(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function stok(): HasOne
    {
        return $this->hasOne(Stok::class, 'variant_id', 'id');
    }
    public function orderItem(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'variant_id', 'id');
    }
}
