<?php

namespace App\Models;

use App\Models\Pembeli;
use App\Models\Produk\ProdukVariant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['pembeli_id', 'variant_id', 'qty'];

    public function variant()
    {
        return $this->belongsTo(ProdukVariant::class);
    }

    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class);
    }
}

