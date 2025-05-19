<?php

namespace App\Models\Transaksi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pembeli;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Order extends Model
{
    protected $with = ['pembeli'];
    public function pembeli():BelongsTo
    {
        return $this->belongsTo(Pembeli::class, 'pembeli_id', 'id');
    }
}
