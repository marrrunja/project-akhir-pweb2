<?php
namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use App\Models\Produk\ProdukVariant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ProdukVariantController extends Controller
{
    private ProdukVariantService $produkVariantService;

    public function __construct(ProdukVariantService $produkVariantService)
    {
        $this->produkVariantService = $produkVariantService;
    }

    public function produkVariant(Request $request):Response|RedirectResponse
use Illuminate\Support\Str;

class ProdukVariantController extends Controller
{
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
            'nama'   => 'required',
            'stok'   => 'required',
            'harga'  => 'required',
            'gambar' => 'required',
        ];
        $request->validate($validate);

        $produkId = $request->id;
        $variant = $request->nama;
        $jumlah = $request->stok;
        $harga = $request->harga;
        $gambar = $request->file('gambar');
        $originalName = Str::replace(' ', '' ,Str::uuid().'-'.$produkId. '-'.$gambar->getClientOriginalName());

        
        $produkId     = $request->id;
        $variant      = $request->nama;
        $jumlah       = $request->stok;
        $harga        = $request->harga;
        $gambar       = $request->file('gambar');
        $originalName = Str::replace(' ', '', Str::uuid() . '-' . $produkId . '-' . $gambar->getClientOriginalName());

        $data = [
            'variant'   => $variant,
            'produk_id' => $produkId,
            'harga' => $harga,
            'foto' => $originalName,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            'harga'     => $harga,
            'foto'      => $originalName,
        ];

        DB::beginTransaction();
        try {
            $insertProdukVariant = DB::table('produk_variants')->insert($data);
            if ($insertProdukVariant > 0) {
                $gambar->storeAs('image-variant', $originalName, 'public');
            }
            $lastInsertProdukVariantId = DB::getPdo()->lastInsertId();
<<<<<<< HEAD
            $data2 = [
                'jumlah' => $jumlah,
                'variant_id' => $lastInsertProdukVariantId,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            $data2      = [
                'jumlah'     => $jumlah,
                'variant_id' => $lastInsertProdukVariantId,
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

        // ambil semua request
        $id           = $request->id;
        $harga        = $request->harga;
        $jumlah       = $request->jumlah;
        $varian       = $request->variant;
        $fotoLama     = $request->foto;
        $fotoBaru     = $request->file('gambar');
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
        }

        $variant = DB::table('produk_variants')->where('id', $id);
        
        $updateVariant = $variant->update(['variant' => $varian,'harga' => $harga, 'foto' => $originalName, 'updated_at' => Carbon::now()]);

        $updateStok = DB::table('stoks')->where('variant_id', $id)->update([
            'jumlah' => $jumlah,
            'updated_at' => Carbon::now()
        $variant       = DB::table('produk_variants')->where('id', $id);
        $updateVariant = $variant->update(['variant' => $varian, 'harga' => $harga, 'foto' => $originalName]);

        $updateStok = DB::table('stoks')->where('variant_id', $id)->update([
            'jumlah' => $jumlah,
        ]);

        $status = null;
        $alert  = null;
        if ($updateVariant > 0 || $updateStok > 0) {
            $status = "Berhasil update data";
            $alert  = "success";
        } else {
            $status = "Tidak ada yang diupdate";
            $alert  = "warning";
        }
        $flashMessage = [
            'status' => $status,
            'alert'  => $alert,
        ];
        return redirect()->back()->with($flashMessage);
    }

    public function search(Request $request): Response
    {
        $keyword  = $request->keyword;
        $products = DB::table('produk_variants')
            ->join('products', 'produk_variants.produk_id', '=', 'products.id')
            ->join('stoks', 'produk_variants.id', '=', 'stoks.variant_id')
            ->select('produk_variants.*', 'products.nama', 'products.detail', 'stoks.jumlah')
            ->where('produk_variants.variant', 'LIKE', '%' . $keyword . '%')
            ->orWhere('products.nama', 'LIKE', '%' . $keyword . '%')
            ->get();
        return response()->view('produk.detail-search', ['products' => $products]);
    }
}
