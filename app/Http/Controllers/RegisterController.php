<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    
    private UserService $userService;

    public function __construct(UserService $userService){
        $this->userService = $userService;
    }

    public function index():Response{
        return response()->view('auth.register-view');
    }
    public function doRegister(Request $request):Response{
        $validatedData = $request->validate([
            'username' => ['required', 'max:20'],
            'password' => ['required'],
            'kecamatan' => ['required'],
            'desa' => ['required'],
            'alamat' => ['required', 'max:255']
        ]);
        if($validatedData){
            $error = null;
            $username = $request->username;
            $password = Hash::make($request->password);
            $desa = $request->desa;
            $jalan = $request->alamat;
            if($this->userService->register($username, $password, $desa, $jalan, $error)){
                return response("Berhasil register");
            }else{
                return response($error);
            }
        }
        return response("Gagal");
        
        
    }
}
