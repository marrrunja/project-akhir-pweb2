<?php 

namespace App\Services\Cart;

use App\Models\Cart;


class CartService
{
    public function addToCart($userId, $variantId, $quantity,?string &$error = null):bool
    {
        if(empty($userId) || empty($variantId) || empty($quantity)){
            $error = "Tidak boleh ada inputan yang kosong";
            return false;
        }
        if($quantity <= 0){
            $error = "Kuantitas tidak boleh kosong";
            return false;
        }
        return true;
    }
    public function removeToCart(int $id):bool
    {
        return true;
    }
    public function updateCart():bool
    {return true;}
}