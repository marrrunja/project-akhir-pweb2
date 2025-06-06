<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use App\Models\Produk\Product;
use App\Models\Produk\ProdukVariant;
use App\Models\Produk\Stok;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    public function index(): Response
    {
        //DB::raw('SUM(price) as total_sales')
        $produk = DB::table('products')->get();
        $data   = [
            'products' => $produk,
        ];
        return response()->view('produk.index', $data);
    }
    public function produkVariant(Request $request): Response | RedirectResponse
    {
        $id = $request->id;
        $variants = ProdukVariant::where('produk_id', $id)->get();
        if ($variants) {
            $data = [
                'variants' => $variants,
            ];
            return response()->view('produk.variant-produk', $data);
        } else {
            return redirect('/produk/index');
        }

    }

    // method untuk menambahkan produk baru
    public function addProduk(Request $request):RedirectResponse
    {
        $validate = [
            'namaProduk' => ['required'],
            'kategori'   => ['required'],
            'deskripsi'  => ['required'],
            'foto'       => ['required', 'mimes:jpeg,jpg,png', 'max:2048'],
            'gambar.*'   => 'file|mimes:jpg,jpeg,png|max:2048',
        ];
        $pesanValidasi = [
            'namaProduk.required' => 'Nama produk tidak boleh kosong!',
            'kategori.required'   => 'Pilih kategori terlebih dahulu!',
            'stok.min'            => 'Stok minimal 1 buah!',
            'deskripsi.required'  => 'Silahkan masukkan deskripsi!',
            'foto.mimes'          => 'File harus foto jpg, jpeg, atau png!',
            'foto.max'            => '2000',
            'foto.required'       => 'Masukkan foto produk!',
        ];
        $request->validate($validate, $pesanValidasi);

        $namaProduk = $request->namaProduk;
        $kategori   = $request->kategori;
        $deskripsi  = $request->deskripsi;

        $foto   = $request->file('foto');
        $gambar = $request->file('gambar');
        // mulai transaksi database/Database Transaction
        DB::beginTransaction();

        try {
            $namaFoto = $request->foto->store('images', 'public');
            DB::table('products')->insert([
                'nama'        => $namaProduk,
                'kategori_id' => $kategori,
                'detail' => $deskripsi,
                'foto' => basename($namaFoto),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            $lastInsertIdProduk = DB::getPdo()->lastInsertId();

            $jumlahVariant = count($request->stok);
            for ($i = 0; $i < $jumlahVariant; $i++) {
                $originalName        = Str::uuid() . '-' . $lastInsertIdProduk . '-' . $gambar[$i]->getClientOriginalName();
                $insertProdukVariant = DB::table('produk_variants')->insert([
                    'variant'   => $request->variant[$i],
                    'produk_id' => $lastInsertIdProduk,
                    'harga' => $request->harga[$i],
                    'foto' => $originalName,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
                if ($insertProdukVariant > 0) {
                    $gambar[$i]->storeAs('image-variant', $originalName, 'public');
                }
                $lastInsertProdukVariantId = DB::getPdo()->lastInsertId();
                DB::table('stoks')->insert([
                    'jumlah' => $request->stok[$i],
                    'variant_id' => $lastInsertProdukVariantId,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
            DB::commit();
            return redirect()->back()->with('status', 'Berhasil menambah produk baru!!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('gagal', 'Gagal menambah produk baru ' . $e->getMessage());
        }
    }

    public function editProduk(Request $request)
    {
        $id         = $request->id;
        $categories = \App\Models\Kategori::all();
        $produk     = Product::where('id', $id)->first();
        $data       = [
            'produk'     => $produk,
            'categories' => $categories,
        ];

        return view('admin.edit-produk', $data);
    }
    public function doEdit(Request $request)
    {
        $id           = $request->id;
        $nama         = $request->nama;
        $detail       = $request->detail;
        $kategori     = $request->kategori;
        $newImage     = $request->file('gambar');
        $oldImage     = $request->gambarLama;
        $originalName = '';

        if ($newImage == null) {
            $originalName = $oldImage;
        } else {
            if (Storage::disk('public')->exists('images/' . $oldImage)) {
                Storage::disk('public')->delete('images/' . $oldImage);
            }
            $originalName = Str::replace(' ', '', Str::uuid() . '-' . $kategori . '-' . $newImage->getClientOriginalName());
            $newImage->storeAs('images', $originalName, 'public');
        }
        // update data
        $produk = DB::table('products')->where('id', '=', $id);
        $update = $produk->update([
            'nama' => $nama, 
            'detail' => $detail, 
            'kategori_id' => $kategori,
            'foto' => $originalName,
            'updated_at' => Carbon::now()
        ]);

        if ($update > 0) {
            $flashMessage = [
                'status' => 'berhasil mengupdate data',
                'alert'  => 'success',
            ];
            return redirect()->back()->with($flashMessage);
        } else {
            $flashMessage = [
                'status' => 'Tidak ada yang diupdate',
                'alert'  => 'primary',
            ];
            return redirect()->back()->with($flashMessage);
        }

    }
    public function searchOnlyProduk(Request $request)
    {
        $keyword  = $request->keyword;
        $products = DB::table('products')->join('kategoris', 'products.kategori_id', 'kategoris.id')
            ->select('products.nama', 'products.detail', 'products.foto', 'products.id', 'kategoris.kategori')
            ->where('products.nama', 'LIKE', '%' . $keyword . '%')
            ->orWhere('kategoris.kategori', 'LIKE', '%' . $keyword . '%')
            ->get();

        $data = [
            'products' => $products,
        ];
        return view('partial.product-search', $data)->render();
    }
    public function detailProduk(Request $request)
    {
        $id = $request->id;
        $produk = Product::where('id', $id)->first();
        return view('detail',compact('produk'));
    }
}
