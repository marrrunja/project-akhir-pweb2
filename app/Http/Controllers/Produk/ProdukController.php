<?php

namespace App\Http\Controllers\Produk;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Produk\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Produk\ProdukVariant;
use Illuminate\Http\RedirectResponse;
use App\Models\Produk\Stok;

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
    public function produkVariant(Request $request):Response
    {
        $id = $request->id;
        $variants = ProdukVariant::where('produk_id', $id)->get();
        // foreach($variants as $variant){
        //     echo $variant->stok->count()."<br>";
        //     echo $variant->variant."<br>";
        // }
        // dump($variants);
        $data = [
            'variants' => $variants
        ];
        return response()->view('produk.variant-produk', $data);
    }
}
