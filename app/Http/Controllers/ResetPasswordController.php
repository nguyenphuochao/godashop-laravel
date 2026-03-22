<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    function showResetForm()
    {
        $email = request()->input('email'); // lấy email từ url hoặc input
        $token = request()->route('token'); // lấy token từ route web.php
        return view('resetpassword.reset', ["email" => $email, "token" => $token]);
    }

    function reset()
    {
        // valid reset token
        $email = request()->input('email');
        $password = request()->input('password');
        $reset_token = request()->input('reset_token');

        $customer = Customer::where('email', $email)->first();

        // Không có email
        if (empty($customer)) {
            session()->put('error', 'Email invalid');
            return redirect()->route('index');
        }

        // token trong DB bằng token trên url
        if ($customer->reset_token == $reset_token) {
            $customer->password = Hash::make($password);
            $customer->reset_token = null;
            $customer->save();
            session()->put('success', 'Cập nhật mật khẩu thành công');
            return redirect()->route('index');
        }

        session()->put('error', 'Token invalid');
        return redirect()->route('index');
    }
}
