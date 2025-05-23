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
            'foto' => ['required','mimes:jpeg,jpg,png', 'max:2000'],
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
        // tambah produk
      

    
       

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
                $variant =
                DB::table('produk_variants')->insert([
                    'variant' => $request->variant[$i],
                    'produk_id' => $lastInsertIdProduk,
                    'harga' => $request->harga[$i]
                ]);
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
            return redirect()->back()->with('gagal', 'Gagal menambah produk baru');
        }
       
        // $produk = new Product();
        // $produk->nama = $namaProduk;
        // $produk->detail = $deskripsi;

        // $produk->kategori_id = $kategori;
        // $produk->foto = basename($namaFoto);
        // $produk->save();

        // $lastInsertIdProduk = $produk->id;

        // // echo $lastInsertIdProduk."<hr>";

        // // // tambah produk variant
        // $produkVariant = new ProdukVariant();
        // $produkVariant->variant = $variant;
        // $produkVariant->produk_id = $lastInsertIdProduk;
        // $produkVariant->harga = $harga;
        // $produkVariant->save();

        // $lastInsertProdukVariantId = $produkVariant->id;
        // echo $lastInsertProdukVariantId . '<hr>';

        // // tambah stok
        // $stok = new Stok();
        // Stok::insert([
        //     'jumlah' => $jumlah,
        //     'variant_id' => $lastInsertProdukVariantId
        // ]);

    }
}
