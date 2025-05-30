<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kategori;
use App\Models\Produk\Stok;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Produk\ProdukVariant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

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
                    ->select('products.nama', 'produk_variants.variant', 'produk_variants.harga','produk_variants.id', 'stoks.jumlah','produk_variants.foto')
                    ->where('products.id', '=', $id)->paginate(10);
        $data = [
            'variants' => $variants,
            'id' => $id
        ];
        return response()->view('admin.variants-produk', $data);
    }
    public function orderList():Response
    {
        $orders = DB::table('pembelis')
                    ->join('table_orders', 'pembelis.id','=','table_orders.pembeli_id')
                    ->select('pembelis.username', 'table_orders.tanggal_transaksi', 'table_orders.is_dibayar', 'table_orders.id')
                    ->get();
        
        return response()->view('admin.order-list',compact('orders'));

    }
    public function orderDetail(Request $request)
    {
        $id = $request->id;
        $orderItems = DB::table('table_orders')
                ->join('order_items', 'table_orders.id', '=', 'order_items.order_id')
                ->join('produk_variants', 'order_items.variant_id', '=', 'produk_variants.id')
                ->join('products', 'produk_variants.produk_id', '=', 'products.id')
                ->select('table_orders.tanggal_transaksi', 'order_items.jumlah', 'order_items.total_harga', 'produk_variants.variant','products.nama','produk_variants.harga')
                ->where('order_items.order_id', '=', $id)
                ->get();
        return response()->view('admin.order-detail', compact('orderItems'));
    }

    public function doEdit(Request $request):RedirectResponse
    {

        // ambil semua request
        $id = $request->id;
        $harga = $request->harga;
        $jumlah = $request->jumlah;
        $varian = $request->variant;
        $fotoLama = $request->foto;
        $fotoBaru = $request->file('gambar');
        $originalName = '';

        // jika foto barunya null(tidak ada) maka isi original name dengan foto lama
        if($fotoBaru == null){
            $originalName = $fotoLama;
        }
        // jika tidak, original name dirangkai dengan mengambil originalName dari foto baru
        else{
            // cek apakah foto lama ada di folder image variant, jika iya, hapus
            if(Storage::disk('public')->exists('image-variant/' . $fotoLama)){
                Storage::disk('public')->delete('image-variant/' . $fotoLama);
            }
            $originalName = Str::replace(' ','', Str::uuid() . '-' . $id . '-' . $fotoBaru->getClientOriginalName());
            $fotoBaru->storeAs('image-variant', $originalName, 'public');
        }


        $variant = DB::table('produk_variants')->where('id', $id);
        $updateVariant = $variant->update(['variant' => $varian,'harga' => $harga, 'foto' => $originalName]);

        $updateStok = DB::table('stoks')->where('variant_id', $id)->update([
            'jumlah' => $jumlah
        ]);
        
        $status = null;
        $alert = null;
        if($updateVariant > 0 || $updateStok > 0){
            $status = "Berhasil update data";
            $alert = "success";
        }
        else {
            $status = "Tidak ada yang diupdate";
            $alert = "warning";
        }
        $flashMessage = [
            'status' => $status,
            'alert' => $alert
        ];
        return redirect()->back()->with($flashMessage);
    }


}
