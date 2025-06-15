<?php
namespace App\Http\Controllers;

use App\Models\Pembeli;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(): Response
    {
        return response()->view('user-index');
    }
    public function profil(Request $request){
        $id = $request->session()->get('user_id');
        $desas = DB::table('desas')->get();
        $kecamatans = DB::table('table_kecamatans')->get();

        $pembeli = DB::table('pembelis')
                    ->join('desas', 'pembelis.kode_desa', '=','desas.kode_desa')
                    ->join('table_kecamatans', 'desas.kecamatan_id', '=', 'table_kecamatans.id')
                    ->select('pembelis.username', 'pembelis.email','pembelis.jalan','pembelis.kode_desa','table_kecamatans.kode_kecamatan')
                    ->where('pembelis.id', '=', $id)
                    ->first();
        $data = [
            'pembeli' => $pembeli,
            'desas' => $desas,
            'kecamatans' => $kecamatans
        ];

        return view('profil',$data);
    }

    public function about()
    {
        return view('about');
    }

    public function updateProfil(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'desa' => 'required',
            'kecamatan' => 'required',
            'alamat' => 'required'
        ]);
        $id = $request->session()->get('user_id');
        $email = $request->email;
        $desa = $request->desa;
        $alamat = $request->alamat;

        $updateUser = DB::table('pembelis')->where('id', $id)->update([
            'email' => $email,
            'kode_desa' => $desa,
            'jalan' => $alamat
        ]);

        $flashMessage = [
        ];

        if($updateUser > 0){
            $flashMessage = [
                'pesan' => 'Berhasil update data',
                'status' => 'success'
            ];
            return redirect()->back()->with($flashMessage);
        }else{
            $flashMessage = [
                'pesan' => 'Belum ada yang diupate',
                'status' => 'question'
            ];
            return redirect()->back()->with($flashMessage);
        }
    }   
}
