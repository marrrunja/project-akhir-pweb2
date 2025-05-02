<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    public function index():Response{
        return response()->view('auth.register-view');
    }
    public function doRegister():Response{
        return response("Berhasil");
    }
}
