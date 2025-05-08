<?php 

namespace App\Services\Cart;

use App\Models\Cart;



class CartService
{
    public function addToCart($userId, $variantId, $quantity,?string $error = null):bool
    {
        if(empty($userId) || empty($variantId) || empty($quantity)){
            $error = "Tidak boleh ada inputan yang kosong";
            return false;
        }
        if($quantity <= 0){
            $error = "Kuantitas tidak boleh kosong";
            return false;
        }
        // Cart::insert([
        //     'pembeli_id' => $userId,
        //     'variant_id' => $variantId,
        //     'qty' => $quantity

        // ]);
        return true;
    }
}