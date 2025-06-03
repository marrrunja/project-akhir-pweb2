<?php
namespace App\Services;

use App\Models\Pembeli;

class UserService
{
    public function register(string $username, string $password, string $alamat, string $jalan,  ? string &$error = null) : bool
    {
        $user = Pembeli::where('username', '=', $username)->first();
        if ($user) {
            $error = "Username sudah ada";
            return false;
        }
        Pembeli::insert([
            'username'  => $username,
            'password'  => $password,
            'kode_desa' => $alamat,
            'jalan'     => $jalan,
        ]);
        return true;
    }

}
