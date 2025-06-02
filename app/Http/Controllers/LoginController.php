<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\LoginService;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    private LoginService $loginService;
    
    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }
    public function index():Response
    {
        return response()->view('auth.login-view');
    }
    public function doLogin(Request $request):RedirectResponse{
        $validate = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);
        $error = null;
        $id = null;
        $username = $request->username;
        $password = $request->password;
        if($this->loginService->login($username, $password, $id, $error)){
            $request->session()->put('username', $username);
            $request->session()->put('user_id', $id);
<<<<<<< HEAD
            return redirect('/');
=======
            return redirect('/')->with('status', "");
>>>>>>> 4a2ffadeb01708ff9f10bff673576bd258ef8791
        }
        return redirect()->back()->with('status', $error);
    }
    public function logout(Request $request):RedirectResponse
    {
        $request->session()->invalidate();
        return redirect('/'); 
    }
}
