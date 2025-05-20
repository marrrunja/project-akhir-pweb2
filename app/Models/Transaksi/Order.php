<?php

namespace App\Models\Transaksi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pembeli;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Transaksi\OrderItem;

class Order extends Model
{
    protected $table = 'table_orders';
    protected $with = ['pembeli'];
    protected $fillable = ['pembeli_id', 'tanggal'];
    public function pembeli():BelongsTo
    {
        return $this->belongsTo(Pembeli::class, 'pembeli_id', 'id');
    }
    public function orderItem():HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
}
