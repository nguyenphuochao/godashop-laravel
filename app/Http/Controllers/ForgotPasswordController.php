<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    function sendResetLinkEmail()
    {
        // dùng hash để mã hóa
        $token = hash('sha256', Str::random(40)); // chuỗi ngẫu nhiên 40 kí tự
        $email  = request()->input('email');

        // store token into table customer
        // Customer::where('email', $email)->update(['reset_token' => $token]);

        $customer = Customer::where('email', $email)->first();
        $customer->reset_token = $token;
        $customer->save();

        $link_reset = route('password.reset', ["token" => $token, "email" => $email]);

        // Send mail
        $input = request()->all();
        $input['link_reset'] = $link_reset;
        $input["customerName"]  = $customer->name;
        Mail::send('forgotpassword.reset', $input,
        function ($message) use ($input) {
            $to = $input['email'];
            $message->to($to, $input["customerName"])->subject('Reset password')->replyTo($input["email"])->from(env("MAIL_SHOP", "nguyenphuochao456@gmail.com"));
        });

        if(Mail::failures()) {
            // error
            session()->put('error', 'Gửi mail không thành công');
        } else {
            // success
            session()->put('success', 'Thành công. Kiểm tra mail của bạn');
        }

        return redirect()->route('index');
    }
}
