<?php

namespace App\Models\Produk;

use App\Models\Produk\ProdukVariant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stok extends Model
{
    protected $hidden = ['variant'];
    protected $fillable = ['jumlah', 'variant_id'];
    public function variant():BelongsTo
    {
        return $this->belongsTo(ProdukVariant::class);
    }
}
