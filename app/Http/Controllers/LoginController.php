<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Không cần validate chỗ này bên server

        $credentials = $request->only(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            $request->session()->put('error', 'Sai thông tin đăng nhập');
            return redirect()->route('index');
        }

        if (Auth()->user()->is_active == 0) { // chưa kích hoạt tài khoản
            Auth::logout();
            $request->session()->put('error', 'Tài khoản chưa kích hoạt');
        }

        return redirect()->route('index');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('index');
    }
}
