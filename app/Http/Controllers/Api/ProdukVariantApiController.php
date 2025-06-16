<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProdukVariantApiController extends Controller
{
    public function editProdukVariant(Request $request):JsonResponse
    {
        $id = $request->id;
        $variant = DB::table('produk_variants')
        ->join('stoks', 'produk_variants.id', '=', 'stoks.variant_id')
        ->select('produk_variants.harga', 'stoks.jumlah','produk_variants.foto', 'produk_variants.variant','produk_variants.id')
        ->where('produk_variants.id', '=', $id)->get();
        
        $data = [
            'variant' => $variant
        ];
        return response()->json($data);
    }
}
