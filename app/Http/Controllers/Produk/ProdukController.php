<?php

namespace App\Http\Controllers\Produk;

use App\Models\Produk\Stok;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Produk\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Produk\ProdukVariant;
use Illuminate\Http\RedirectResponse;

class ProdukController extends Controller
{
    public function index():Response
    {
        //DB::raw('SUM(price) as total_sales')
        $produk = DB::table('products')->get();
        $data = [
            'products' => $produk
        ];
        return response()->view('produk.index',$data);
    }
    public function produkVariant(Request $request):Response|RedirectResponse
    {
        $id = $request->id;
        $variants = ProdukVariant::where('produk_id', $id)->get();
        if($variants){
            $data = [
                'variants' => $variants
            ];  
            return response()->view('produk.variant-produk', $data);
        }
        else
            return redirect('/produk/index');
    }

    // method untuk menambahkan produk baru

    public function addProduk(Request $request)
    {
        $validate = [
            'namaProduk' => ['required'],
            'kategori' => ['required'],
            'deskripsi' => ['required'],
            'foto' => ['required','mimes:jpeg,jpg,png', 'max:2048'],
            'gambar.*' =>  'file|mimes:jpg,jpeg,png|max:2048',
        ];
        $pesanValidasi = [
            'namaProduk.required' => 'Nama produk tidak boleh kosong!',
            'kategori.required' => 'Pilih kategori terlebih dahulu!',
            'stok.min' => 'Stok minimal 1 buah!',
            'deskripsi.required' => 'Silahkan masukkan deskripsi!',
            'foto.mimes' => 'File harus foto jpg, jpeg, atau png!',
            'foto.max' => '2000',
            'foto.required' => 'Masukkan foto produk!'
        ];
        $request->validate($validate, $pesanValidasi);

        $namaProduk = $request->namaProduk;
        $kategori = $request->kategori;
        $deskripsi = $request->deskripsi;
     
        $foto = $request->file('foto');
        $gambar = $request->file('gambar');

        // mulai transaksi database/Database Transaction   
        DB::beginTransaction();

        try{
            $namaFoto = $request->foto->store('images', 'public');
            DB::table('products')->insert([
                'nama' => $namaProduk,
                'kategori_id' => $kategori,
                'detail' => $deskripsi,
                'foto' => basename($namaFoto)
            ]);

            $lastInsertIdProduk = DB::getPdo()->lastInsertId();

            $jumlahVariant = count($request->stok);
            for($i = 0; $i < $jumlahVariant; $i++){
                $originalName = Str::uuid().'-'.$lastInsertIdProduk. '-'.$gambar[$i]->getClientOriginalName();
                $insertProdukVariant = DB::table('produk_variants')->insert([

                    'variant' => $request->variant[$i],
                    'produk_id' => $lastInsertIdProduk,
                    'harga' => $request->harga[$i],
                    'foto' => $originalName
                ]);
                if($insertProdukVariant > 0){
                    $gambar[$i]->storeAs('image-variant', $originalName, 'public');
                }
                $lastInsertProdukVariantId = DB::getPdo()->lastInsertId();
                DB::table('stoks')->insert([
                    'jumlah' => $request->stok[$i],
                    'variant_id' => $lastInsertProdukVariantId
                ]);
            }
            DB::commit();
            return redirect()->back()->with('status', 'Berhasil menambah produk baru!!');

        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with('gagal', 'Gagal menambah produk baru '. $e->getMessage());
        }
    }
    
    public function addProdukVariant(Request $request)
    {
        $validate = [
            'nama' => 'required',
            'stok' => 'required',
            'harga' => 'required',
            'gambar' => 'required',
        ];
        $request->validate($validate);

        $produkId = $request->id;
        $variant = $request->nama;
        $jumlah = $request->stok;
        $harga = $request->harga;
        $gambar = $request->file('gambar');
        $originalName = Str::replace(' ', '' ,Str::uuid().'-'.$produkId. '-'.$gambar->getClientOriginalName());
        
        $data = [
            'variant' => $variant,
            'produk_id' => $produkId,
            'harga' => $harga,
            'foto' => $originalName
        ];
        DB::beginTransaction();
        try{
            $insertProdukVariant = DB::table('produk_variants')->insert($data);
            if($insertProdukVariant > 0) {
                $gambar->storeAs('image-variant', $originalName, 'public');
            }
            $lastInsertProdukVariantId = DB::getPdo()->lastInsertId();
            $data2 = [
                'jumlah' => $jumlah,
                'variant_id' => $lastInsertProdukVariantId
            ];

            DB::table('stoks')->insert($data2);

            DB::commit();
            $flashMessage = [
                'status' => "berhasil menambah data variant",
                'alert' => "success"
            ];
            return redirect()->back()->with($flashMessage);
        }catch(\Exception $e){
            DB::rollback();
            $flashMessage = [
                'status' => "Gagal menambah data variant " . $e->getMessage(),
                'alert' => "danger"
            ];
            return redirect()->back()->with($flashMessage);
        }
    }

    public function search(Request $request):Response
    {
        $keyword = $request->keyword;
        $products = DB::table('produk_variants')
            ->join('products', 'produk_variants.produk_id', '=', 'products.id')
            ->join('stoks', 'produk_variants.id', '=', 'stoks.variant_id')
            ->select('produk_variants.*', 'products.nama', 'products.detail', 'stoks.jumlah')
            ->where('produk_variants.variant', 'LIKE', '%'.$keyword.'%')
            ->orWhere('products.nama', 'LIKE', '%'.$keyword.'%')
            ->get();
        return response()->view('produk.detail-search', ['products' => $products]);
    }
}
