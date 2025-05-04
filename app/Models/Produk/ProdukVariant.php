<?php

namespace App\Models\Produk;

use App\Models\Produk\Stok;
use App\Models\Produk\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProdukVariant extends Model
{
    protected $with = ['produk']; 
    public function produk():BelongsTo
    {
        return $this->belongsTo(Product::class);   
    }
    public function stok():HasMany
    {
        return $this->hasMany(Stok::class, 'variant_id');
    }
}
