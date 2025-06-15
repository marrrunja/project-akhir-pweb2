<?php

namespace App\Services;

use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminService
{
    public function login(array $data, ?string &$error = null, ?string &$username = null):bool
    {
        $admin = DB::table('admins')->where('username', '=', $data['username'])->first();

        if(!$admin){
            $error = "Username atau password salah";
            return false;
        }
        if(!Hash::check($data['password'], $admin->password)){
            $error = "Username atau password salah";
            return false;
        }
        $username = $admin->username;
        return true;
    }
}