<?php

namespace App\Models\Transaksi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Produk\ProdukVariant;
class OrderItem extends Model
{
    public function produkVarian(): BelongsTo
    {
        return $this->belongsTo(ProdukVariant::class);
    }
}
