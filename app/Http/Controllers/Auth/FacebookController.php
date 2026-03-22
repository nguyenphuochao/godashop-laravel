<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    function handleFacebookCallback()
    {
        try {
            $facebookCustomer = Socialite::driver('facebook')->user();
            $existingCustomer = Customer::where('facebook_id', $facebookCustomer->id)
                                        ->orWhere('email', $facebookCustomer->email)->first();

            if (empty($existingCustomer)) {
                // insert into database
                $customer = new Customer();
                $customer->facebook_id= $facebookCustomer->id;
                $customer->name = $facebookCustomer->name;
                $customer->email = $facebookCustomer->email;
                $customer->is_active = 1;
                $customer->login_by = 'Facebook';
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
