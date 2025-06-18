<?php
namespace App\Http\Controllers\Produk;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Produk\ProdukVariant;
use Intervention\Image\ImageManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use App\Services\Produk\ProdukVariantService;

class ProdukVariantController extends Controller
{
    private ProdukVariantService $produkVariantService;

    public function __construct(ProdukVariantService $produkVariantService)
    {
        $this->produkVariantService = $produkVariantService;
    }

    public function produkVariant(Request $request): Response | RedirectResponse
    {
        $id       = $request->id;
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

    public function addProdukVariant(Request $request)
    {
        $validate = [
            'variant'   => 'required',
            'stok'   => 'required|integer|min:1',
            'harga'  => 'required|integer|min:1000',
            'gambar' => 'required|image|mimes:jpg,jpeg,png,webp',
        ];
        $pesanValidasi = [
            'variant.required' => 'Variant harus diisi',
            'stok.required' => 'Stok Harus diisi',
            'stok.integer' => 'Stok harus bilangan bulat',
            'stok.min' => 'Stok minimal 1',
            'harga.required' => 'Harga harus diisi',
            'harga.integer' => 'Harga harus bilangan bulat',
            'harga.min' => 'Harga minimal 1000 rupiah',
            'gambar.required' => 'Gambar harus diupload',
            'gambar.image' => 'Anda memasukkan file yang bukan gambar',
            'gambar.mimes' => 'Ekstensi gambar harus jpg, png, jpeg, atau webp'
        ];
        $request->validate($validate, $pesanValidasi);

        $produkId = $request->id;
        $variant = $request->variant;
        $jumlah = $request->stok;
        $harga = $request->harga;
        $gambar = $request->file('gambar');
        $originalName = Str::replace(' ', '' ,Str::uuid().'-'.$produkId. '-'.$gambar->getClientOriginalName());
        $data = [
            'variant'   => $variant,
            'produk_id' => $produkId,
            'harga' => $harga,
            'foto' => $originalName,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        DB::beginTransaction();
        try {
            $insertProdukVariant = DB::table('produk_variants')->insert($data);
            if ($insertProdukVariant > 0) {
                $manager = new ImageManager(new Driver());
                $gambar->storeAs('image-variant', $originalName, 'public');
                $image = $manager->read(public_path("storage/image-variant/{$originalName}"))->cover(1200,1200);
                $image->save();
            }
            $lastInsertProdukVariantId = DB::getPdo()->lastInsertId();
            $data2 = [
                'jumlah' => $jumlah,
                'variant_id' => $lastInsertProdukVariantId,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];

            DB::table('stoks')->insert($data2);

            DB::commit();
            $flashMessage = [
                'status' => "berhasil menambah data variant",
                'alert'  => "success",
            ];
            return redirect()->back()->with($flashMessage);
        } catch (\Exception $e) {
            DB::rollback();
            $flashMessage = [
                'status' => "Gagal menambah data variant " . $e->getMessage(),
                'alert'  => "danger",
            ];
            return redirect()->back()->with($flashMessage);
        }
    }
    public function doEdit(Request $request):RedirectResponse
    {
        $validate = [
            'variant'   => 'required',
            'jumlah'   => 'required|integer|min:1',
            'harga'  => 'required|integer|min:1000',
            'gambar' => 'image|mimes:jpg,jpeg,png,webp',
        ];
        $pesanValidasi = [
            'variant.required' => 'Variant harus diisi',
            'jumlah.required' => 'Stok Harus diisi',
            'jumlah.integer' => 'Stok harus bilangan bulat',
            'jumlah.min' => 'Stok minimal 1',
            'harga.required' => 'Harga harus diisi',
            'harga.integer' => 'Harga harus bilangan bulat',
            'harga.min' => 'Harga minimal 1000 rupiah',
            'gambar.image' => 'Anda memasukkan file yang bukan gambar',
            'gambar.mimes' => 'Ekstensi gambar harus jpg, png, jpeg, atau webp'
        ];
        $request->validate($validate, $pesanValidasi);

        // ambil semua request
        $id = $request->id;
        $harga = $request->harga;
        $jumlah = $request->jumlah;
        $varian = $request->variant;
        $fotoLama = $request->foto;
        $fotoBaru = $request->file('gambar');
        $originalName = '';

        // jika foto barunya null(tidak ada) maka isi original name dengan foto lama
        if ($fotoBaru == null) {
            $originalName = $fotoLama;
        }
        // jika tidak, original name dirangkai dengan mengambil originalName dari foto baru
        else {
            // cek apakah foto lama ada di folder image variant, jika iya, hapus
            if (Storage::disk('public')->exists('image-variant/' . $fotoLama)) {
                Storage::disk('public')->delete('image-variant/' . $fotoLama);
            }
            $originalName = Str::replace(' ', '', Str::uuid() . '-' . $id . '-' . $fotoBaru->getClientOriginalName());
            $fotoBaru->storeAs('image-variant', $originalName, 'public');
            $manager = new ImageManager(new Driver());
            $image = $manager->read(public_path("storage/image-variant/{$originalName}"))->cover(1200,1200);
            $image->save();
        }

        $variant = DB::table('produk_variants')->where('id', $id);
        
        $updateVariant = $variant->update(['variant' => $varian,'harga' => $harga, 'foto' => $originalName]);

        $updateStok = DB::table('stoks')->where('variant_id', $id)->update([
            'jumlah' => $jumlah,
        ]);
     
        $status = null;
        $alert  = null;
        if ($updateVariant > 0 || $updateStok > 0) {
            DB::table('stoks')->where('variant_id', $id)->update([
            'updated_at' => Carbon::now()
            ]);
            $variant->update(['updated_at' => Carbon::now()]);

            $status = "Berhasil update data";
            $alert  = "success";
            $flashMessage = [
                'status' => $status,
                'alert'  => $alert,
            ];
            return redirect()->back()->with($flashMessage);
        } else {
            $flashMessage = [
                'status' => "Tidak ada yang diupdate",
                'alert' => 'warning'
            ];
            return redirect()->back()->with($flashMessage);
        }
    }

    public function search(Request $request): Response|RedirectResponse
    {
        $keyword  = $request->keyword;
        if($keyword === ''){
            return redirect()->back();
        }
        $products = DB::table('produk_variants')
            ->join('products', 'produk_variants.produk_id', '=', 'products.id')
            ->join('stoks', 'produk_variants.id', '=', 'stoks.variant_id')
            ->select('produk_variants.*', 'products.nama', 'products.detail', 'stoks.jumlah')
            ->where('produk_variants.variant', 'LIKE', '%' . $keyword . '%')
            ->orWhere('products.nama', 'LIKE', '%' . $keyword . '%')
            ->paginate(8);
        return response()->view('produk.detail-search', ['products' => $products]);
    }
}
