<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    function handleGoogleCallback()
    {
        try {
            $googleCustomer = Socialite::driver('google')->user();
            $existingCustomer = Customer::where('google_id', $googleCustomer->id)
                                        ->orWhere('email', $googleCustomer->email)->first();

            if (empty($existingCustomer)) {
                // insert into database
                $customer = new Customer();
                $customer->google_id = $googleCustomer->id;
                $customer->name = $googleCustomer->name;
                $customer->email = $googleCustomer->email;
                $customer->is_active = 1;
                $customer->login_by = 'Google';
                $customer->save();
                Auth::login($customer);
            } else {
                Auth::login($existingCustomer);
            }

            return redirect('/');

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
