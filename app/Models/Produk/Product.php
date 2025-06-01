<?php

namespace App\Models\Produk;

use App\Models\Kategori;
use App\Models\Produk\ProdukVariant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $with = ['kategori'];
    protected $table = 'products';
    protected $guarded = ['id'];

    public function variant(): HasMany
    {
        return $this->hasMany(ProdukVariant::class, 'produk_id', 'id');
    }
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }
}
