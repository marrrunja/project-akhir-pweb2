<?php

namespace App\Http\Controllers\Produk;

use Carbon\Carbon;
use App\Models\Produk\Stok;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Produk\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Produk\ProdukVariant;
use Intervention\Image\ImageManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;

class ProdukController extends Controller
{
    public function index(): Response
    {
        $produk = DB::table('products')
        ->join('kategoris', 'products.kategori_id', '=', 'kategoris.id')
        ->select('products.id as idProduk', 'products.nama', 'products.detail', 'products.foto', 'kategoris.kategori', 'kategoris.id')
        ->paginate(8);
        $data   = [
            'products' => $produk,
        ];
        return response()->view('produk.index', $data);
    }
    public function dashboard(): Response
    {
        $produk = DB::table('products')
        ->join('kategoris', 'products.kategori_id', '=', 'kategoris.id')
        ->select('products.id as idProduk', 'products.nama', 'products.detail', 'products.foto', 'kategoris.kategori', 'kategoris.id')
        ->limit(8)
        ->get();
        $data   = [
            'products' => $produk,
        ];
        return response()->view('user-index', $data);
    }
    public function detailProdukModal(Request $request)
    {
        $id = $request->id;
        $produk = DB::table('products')
        ->join('kategoris', 'products.kategori_id', '=', 'kategoris.id')
        ->select('products.id as idProduk', 'products.nama', 'products.detail', 'products.foto', 'kategoris.kategori', 'kategoris.id')
        ->where('products.id', '=', $id)
        ->first();
        $data   = [
            'produk' => $produk,
        ];

        return view('partial.detail-produk', $data)->render();
    }
    public function getProdukByKategoriId(Request $request)
    {
        $id = $request->kategori;
        echo $id;
        
        $produk = DB::table('products')
        ->join('kategoris', 'products.kategori_id', '=', 'kategoris.id')
        ->select('products.id as idProduk', 'products.nama', 'products.detail', 'products.foto', 'kategoris.kategori', 'kategoris.id');
        if($id != 'null'){
            $produk = $produk->where('products.kategori_id', '=', $id)->get();
        }
        else {
            $produk = $produk->get();
        }

        $data   = [
            'products' => $produk,
        ];

        return view('partial.produk-by-kategori-id', $data)->render();

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
            'foto'       => ['required', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
            'gambar.*'   => 'file|mimes:jpg,jpeg,png,webp|max:2048',
        ];
        $pesanValidasi = [
            'namaProduk.required' => 'Nama produk tidak boleh kosong!',
            'kategori.required'   => 'Pilih kategori terlebih dahulu!',
            'stok.min'            => 'Stok minimal 1 buah!',
            'deskripsi.required'  => 'Silahkan masukkan deskripsi!',
            'foto.mimes'          => 'File harus foto jpg, jpeg, atau png dan webp!',
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
            $fotoToInsert = basename($namaFoto);
            DB::table('products')->insert([
                'nama'        => $namaProduk,
                'kategori_id' => $kategori,
                'detail' => $deskripsi,
                'foto' => $fotoToInsert,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            $manager = new ImageManager(new Driver());
            $image = $manager->read(public_path("storage/images/{$fotoToInsert}"))->cover(1200,1200);
            $image->save();

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
                $imageToInsert = $manager->read(public_path("storage/image-variant/{$originalName}"))->cover(1200,1200);
                $imageToInsert->save();
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
        $validate = $request->validate([
            'nama' => 'required',
            'detail' => 'required',
            'kategori' => 'required',
            'gambar' => 'mimes:jpg,jpeg,png,webp|max:3000'
        ]);

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
            $manager = new ImageManager(new Driver());
            $image = $manager->read(public_path("storage/images/{$originalName}"))->cover(1200,1200);
            $image->save();
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
