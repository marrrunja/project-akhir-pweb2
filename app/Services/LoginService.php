<?php 
namespace App\Services;

use App\Models\Pembeli;
use Illuminate\Support\Facades\Hash;

class LoginService
{
    public function login(string $username, string $password,?int &$id = null, ?string &$error = null):bool
    {
        $pembeli = Pembeli::where('username', '=', $username)->first();
        if($pembeli){
            if(Hash::check($password, $pembeli->password)){
                $id = $pembeli->id;
                return true;
            }
            $error = 'Password salah';
            return false;
        }
        $error = 'Username tidak valid';
        return false;
    }
}