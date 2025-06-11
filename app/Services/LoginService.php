<?php
namespace App\Services;

use App\Models\Pembeli;
use Illuminate\Support\Facades\Hash;

class LoginService
{
    public function login(array $data, ?string &$id = null, ?string &$error = null) : bool
    {
        $pembeli = Pembeli::where('username', '=', $data['username'])->first();
        if ($pembeli) {
            if (Hash::check($data['password'], $pembeli->password)) {
                $id = $pembeli->id;
                return true;
            }
            $error = 'Username atau Password salah';
            return false;
        }
        $error = 'Username atau Password salah';
        return false;
    }
}
