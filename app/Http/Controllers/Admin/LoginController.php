<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function index()
    {
        return view('admin.login.index');
    }

    function login(Request $request)
    {
        $credentials = $request->only(['username', 'password']);

        if (!Auth::guard('admin')->attempt($credentials)) {
            $request->session()->put('error', 'Sai thông tin đăng nhập');
            return redirect()->route('admin.login.form');
        }

        if (Auth::guard('admin')->user()->is_active == 0) {
            $request->session()->put('error', 'Tài khoản đăng nhập bị khóa');
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login.form');
        }

        return redirect('/admin');
    }

    function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login.form');
    }
}
