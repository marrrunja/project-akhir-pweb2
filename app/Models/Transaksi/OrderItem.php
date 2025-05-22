<?php

namespace App\Models\Transaksi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Produk\ProdukVariant;
use App\Models\Transaksi\Order;
class OrderItem extends Model
{
    public function produkVarian(): BelongsTo
    {
        return $this->belongsTo(ProdukVariant::class);
    }
    public function order():BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
