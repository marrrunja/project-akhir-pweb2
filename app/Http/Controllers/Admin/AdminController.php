<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Produk\Product;
use App\Services\AdminService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct(private AdminService $adminService){}
    public function index(): Response
    {
        // pendapatan
        $pendapatan = DB::table('table_orders')
            ->select(DB::raw('SUM(total_harga) as total'))
            ->where('is_dibayar', '=', 1)
            ->first();
        $rerata = DB::table('table_orders')
            ->select(DB::raw('AVG(total_harga) as rerata'))
            ->where('is_dibayar', '=', 1)
            ->first();
        $pending = DB::table('table_orders')
            ->select(DB::raw('count(*) as jumlah'))
            ->where('is_dibayar', '=', 0)
            ->first();
        $data = [
            'pendapatan' => $pendapatan->total,
            'rerata' => $rerata->rerata,
            'pending' => $pending->jumlah
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
    public function lihatProduk(): Response
    {
        $products = DB::table('products')
            ->join('kategoris', 'products.kategori_id', 'kategoris.id')

            ->select(
                'products.id',
                'products.nama',
                'products.detail',
                'products.foto'
                ,
                'kategoris.kategori'
            )
            ->paginate(5);
        $data = [
            'products' => $products
        ];
        return response()->view('admin.daftar-produk', $data);
    }
    public function variantProduk(Request $request): Response
    {
        $id = $request->id;
        $produk = Product::where('id', $id)->first();
        $variants = DB::table('products')
            ->join('kategoris', 'products.kategori_id', '=', 'kategoris.id')
            ->join('produk_variants', 'products.id', '=', 'produk_variants.produk_id')
            ->join('stoks', 'produk_variants.id', 'stoks.variant_id')
            ->select('products.nama', 'produk_variants.variant', 'produk_variants.harga', 'produk_variants.id', 'stoks.jumlah', 'produk_variants.foto')
            ->where('products.id', '=', $id)->paginate(10);
        $data = [
            'variants' => $variants,
            'id' => $id,
            'nama' => $produk->nama

        ];
        return response()->view('admin.variants-produk', $data);
    }
    public function orderList(): Response
    {
        $orders = DB::table('pembelis')
            ->join('table_orders', 'pembelis.id', '=', 'table_orders.pembeli_id')
            ->select('pembelis.username', 'table_orders.tanggal_transaksi', 'table_orders.is_dibayar', 'table_orders.id')
            ->get();

        return response()->view('admin.order-list', compact('orders'));

    }
    public function orderDetail(Request $request)
    {
        $id = $request->id;
        $orderItems = DB::table('table_orders')
            ->join('order_items', 'table_orders.id', '=', 'order_items.order_id')
            ->join('produk_variants', 'order_items.variant_id', '=', 'produk_variants.id')
            ->join('products', 'produk_variants.produk_id', '=', 'products.id')
            ->select('table_orders.tanggal_transaksi', 'order_items.jumlah', 'order_items.total_harga', 'produk_variants.variant', 'products.nama', 'produk_variants.harga', 'produk_variants.foto')
            ->where('order_items.order_id', '=', $id)
            ->get();
        return response()->view('admin.order-detail', compact('orderItems'));
    }

    public function login()
    {
        return view('admin.login');
    }
    public function doLogin(Request $request){
        $validate = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $name = $request->username;
        $password  = $request->password;
        $username = null;
        $error = null;
        $data =  [
            'username' => $name,
            'password' => $password
        ];
        if($this->adminService->login($data, $error, $username)){
            $request->session()->put('admin', $username);
            return redirect('/admin/index');
        }else
            return redirect()->back()->with('status', $error);
    }
    public function doLogout(Request $request):JsonResponse{
        $request->session()->forget('admin');
        return response()->json(['redirect_url' => '/admin/login'],200);
    }
}
