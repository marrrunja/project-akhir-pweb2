<?php
namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    private UserService $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    
    public function index():Response {
        return response()->view('auth.register-view');
    }

    public function doRegister(Request $request):Response{
        $validatedData = $request->validate([
            'username'  => ['required', 'max:20','min:10'],
            'email' => ['required', 'email:rfc,dns'],
            'password'  => ['required', 'min:5'],
            'kecamatan' => ['required'],
            'desa'      => ['required'],
            'alamat'    => ['required', 'max:255'],
        ]);
        if ($validatedData) {
            $error    = null;
            $username = $request->username;
            $password = Hash::make($request->password);
            $desa     = $request->desa;
            $jalan    = $request->alamat;
            $email = $request->email;
            $data = [
                'username' => $username,
                'password' => $password,
                'email' => $email,
                'alamat' => $desa,
                'jalan' => $jalan
            ];

            if ($this->userService->register($data, $error)) {
                return response("Berhasil register");
            } else {
                return response($error);
            }

        }
        return response("Gagal");
    }
}
