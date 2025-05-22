<?php

namespace App\Models\Produk;

use App\Models\Produk\ProdukVariant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stok extends Model
{
    public function variant():BelongsTo
    {
        return $this->belongsTo(ProdukVariant::class);
    }
}
