<?php

namespace App\Http\Controllers\Produk;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Produk\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class ProdukController extends Controller
{
    public function index():Response
    {
        $produk = Product::all();
        $data = [
            'products' => $produk
        ];
        return response()->view('produk.index',$data);
    }
}
