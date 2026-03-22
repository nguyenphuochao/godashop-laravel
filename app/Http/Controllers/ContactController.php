<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    function show()
    {
        return view('contact.show');
    }

    function sendEmail(Request $request)
    {
        // cách 1
        $input = $request->all(); // lấy tất cả các request

        Mail::send('contact.sendmail', $input,

        function ($message) use ($input) {
            $to = env("MAIL_SHOP", 'nguyenphuochao456@gmail.com');
            $message->to($to, 'Godashop')
            ->subject("Godashop: customer contact {$input['fullname']}")
            ->replyTo($input["email"])
            ->from($input["email"]);
        });

        if(Mail::failures()) {
            // error
            echo 'Khong the gui mail. Lien hệ admin';
        } else {
            // success
            echo 'Gửi mail thành công';
        }

        // Cách 2 dùng try...catch
        // code here
    }
}
