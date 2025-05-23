<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    public function index():Response
    {
        $categories = Kategori::all();
        $data = [
            'categories' => $categories,
        ];
        return response()->view('admin.index', $data);
    }
    public function tambah()
    {
        $categories = Kategori::all();
        $data = [
            'categories' => $categories,
        ];
        return response()->view('admin.tambah', $data);
    }
    public function lihatProduk():Response
    {
        $products = DB::table('products')
                    ->join('kategoris', 'products.kategori_id', 'kategoris.id')

                    ->select('products.id', 'products.nama', 'products.detail','products.foto'
                    ,'kategoris.kategori')
                    ->get();
        $data = [
            'products' => $products
        ];
        return response()->view('admin.daftar-produk', $data);
    }
    public function variantProduk(Request $request):Response
    {

        $id = $request->id;
        $variants = DB::table('products')
                    ->join('kategoris', 'products.kategori_id', '=','kategoris.id')
                    ->join('produk_variants', 'products.id', '=','produk_variants.produk_id')
                    ->join('stoks', 'produk_variants.id', 'stoks.variant_id')
                    ->select('products.nama', 'produk_variants.variant', 'produk_variants.harga','produk_variants.id', 'stoks.jumlah')
                    ->where('products.id', '=', $id)->paginate(10);
           
        return response()->view('admin.variants-produk', compact('variants'));
    }

    public function editProdukVariant(Request $request)
    {
        return "Hello";
    }
}
