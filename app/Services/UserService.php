<?php

namespace App\Services;

use App\Models\Pembeli;

class UserService
{
    public function register(array $data, ?string &$error = null) : bool
    {
        $user = Pembeli::where('username', '=', $data['username'])->first();
        if ($user) {
            $error = "Username sudah ada";
            return false;
        }
        Pembeli::insert([
            'username'  => $data['username'],
            'password'  => $data['password'],
            'email' => $data['email'],
            'kode_desa' => $data['alamat'],
            'jalan'     => $data['jalan'],
        ]);
        return true;
    }

}
