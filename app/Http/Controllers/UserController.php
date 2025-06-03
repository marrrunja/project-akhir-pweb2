<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index():Response
    {
        return response()->view('user-index');
    }
    public function profil(){
        return view('profil');
    }
}
