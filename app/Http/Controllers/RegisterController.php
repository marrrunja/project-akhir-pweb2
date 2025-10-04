<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    private UserService $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    
    public function index():Response {
        return response()->view('auth.register-view');
    }

    public function doRegister(Request $request):Response|RedirectResponse{
        $validatedData = $request->validate([
            'username'  => ['required', 'max:20','min:6'],
            'email' => ['required', 'email:rfc,dns'],
            'password'  => ['required', 'min:5'],
            'kecamatan' => ['required'],
            'desa'      => ['required'],
            'alamat'    => ['required', 'max:255'],
        ]);
        if ($validatedData) {
            $error    = null;
            $username = $request->username;
            $password = Hash::make($request->password);
            $desa     = $request->desa;
            $jalan    = $request->alamat;
            $email = $request->email;
            $data = [
                'username' => $username,
                'password' => $password,
                'email' => $email,
                'alamat' => $desa,
                'jalan' => $jalan
            ];

            if ($this->userService->register($data, $error)) {
                $flashMessage = [
                    'status' => 'Berhasil Register'
                ];
                return redirect()->back()->with($flashMessage);
            } else {
                return redirect()->back()->with('status', $error);
            }

        }
    }
}
