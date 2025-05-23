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
            'stok' => ['integer', 'min:1'],
            'deskripsi' => ['required'],
            'foto' => ['required','mimes:jpeg,jpg,png', 'max:2000'],
            'variant' => ['required'],
            'harga' => ['required','integer', 'min:2000'],
        ];
        $pesanValidasi = [
            'namaProduk.required' => 'Nama produk tidak boleh kosong!',
            'kategori.required' => 'Pilih kategori terlebih dahulu!',
            'stok.integer' => 'Stok harus bertipe angka!',
            'stok.min' => 'Stok minimal 1 buah!',
            'deskripsi.required' => 'Silahkan masukkan deskripsi!',
            'foto.mimes' => 'File harus foto jpg, jpeg, atau png!',
            'foto.max' => '2000',
            'variant.required' => 'Variant produk tidak boleh kosong!!',
            'harga.required' => 'Silahkan masukkan harga produknya terlebih dahulu',
            'harga.integer' => 'Harga harus bertipe data integer!!',
            'harga.min' => 'Harga produk minimal RP 2.000',
            'foto.required' => 'Masukkan foto produk!'
        ];
        $request->validate($validate, $pesanValidasi);

        $namaProduk = $request->namaProduk;
        $kategori = $request->kategori;
        $jumlah = $request->stok;
        $deskripsi = $request->deskripsi;
        $variant = $request->variant;
        $harga = $request->harga;
        $foto = $request->file('foto');

        echo $jumlah;
        // tambah produk
        $namaFoto = $request->foto->store('images', 'public');

        DB::beginTransaction();

        try{
            DB::table('products')->insert([
                'nama' => $namaProduk,
                'kategori_id' => $kategori,
                'detail' => $deskripsi,
                'foto' => basename($namaFoto)
            ]);
            $lastInsertIdProduk = DB::getPdo()->lastInsertId();

            DB::table('produk_variants')->insert([
                'variant' => $variant,
                'produk_id' => $lastInsertIdProduk,
                'harga' => $harga
            ]);
            $lastInsertProdukVariantId = DB::getPdo()->lastInsertId();

            DB::table('stoks')->insert([
                'jumlah' => $jumlah,
                'variant_id' => $lastInsertProdukVariantId
            ]);
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
