<?php

namespace App\Models\Transaksi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class OrderItem extends Model
{
    public function produkVarian(): BelongsTo
    {
        
    }
}
