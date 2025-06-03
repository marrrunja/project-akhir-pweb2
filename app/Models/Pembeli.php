<?php
namespace App\Models;

use App\Models\Transaksi\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pembeli extends Model
{
    public function order(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
