<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
class CobaController extends Controller
{
    public function index():Response
    {
        return response()->view('form-view');
    }
    public function requestPost(Request $request)
    {
        $data = $request->only('nama', 'nim');
        return json_encode($data);
    }
    public function requestPostWithRedirect():RedirectResponse
    {
        return redirect("/");
    }
}