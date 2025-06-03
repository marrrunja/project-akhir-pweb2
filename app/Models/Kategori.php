<?php
namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    public $incrementing = false;

    public function produk(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
