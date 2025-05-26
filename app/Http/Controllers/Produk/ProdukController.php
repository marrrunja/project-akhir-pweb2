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
    public function index(): Response
    {
        $produk = Product::all();
        $data = [
            'products' => $produk
        ];
        return response()->view('produk.index', $data);
    }
    public function produkVariant(Request $request): Response|RedirectResponse
    {
        $id = $request->id;
        $variants = ProdukVariant::where('produk_id', $id)->get();
        if ($variants) {
            $data = [
                'variants' => $variants
            ];
            return response()->view('produk.variant-produk', $data);
        } else
            return redirect('/produk/index');
    }

    // method untuk menambahkan produk baru

    public function addProduk(Request $request)
    {
        $validate = [
            'namaProduk' => ['required'],
            'kategori' => ['required'],
            'deskripsi' => ['required'],
            'foto' => ['required', 'mimes:jpeg,jpg,png', 'max:2000'],
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




        // mulai transaksi database/Database Transaction   
        DB::beginTransaction();

        try {
            $namaFoto = $request->foto->store('images', 'public');
            DB::table('products')->insert([
                'nama' => $namaProduk,
                'kategori_id' => $kategori,
                'detail' => $deskripsi,
                'foto' => basename($namaFoto)
            ]);
            $lastInsertIdProduk = DB::getPdo()->lastInsertId();

            $jumlahVariant = count($request->stok);
            for ($i = 0; $i < $jumlahVariant; $i++) {
                $variant = $request->variant[$i];
                $harga = $request->harga[$i];
                $stok = $request->stok[$i];
                DB::table('produk_variants')->insert([
                    'variant' => $variant,
                    'produk_id' => $lastInsertIdProduk,
                    'harga' => $harga
                ]);
                $lastInsertProdukVariantId = DB::getPdo()->lastInsertId();

                DB::table('stoks')->insert([
                    'jumlah' => $stok,
                    'variant_id' => $lastInsertProdukVariantId
                ]);
            }
            DB::commit();
            return redirect()->back()->with('status', 'Berhasil menambah produk baru!!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('gagal', 'Gagal menambah produk baru');
        }
    }
}
