<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display the customer's account information page.
     *
     * @return \Illuminate\Contracts\View\View
     */

    public function show()
    {
        $data = [];
        return view('customer.show', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dùng auth session lưu luôn
        /*
        $customer = Auth()->user();
        $customer->save();
        */
        $customer = Auth::user();
        $customer->name = $request->input('fullname');
        $customer->mobile = $request->input('mobile');
        $oldPassword = $request->input('old_password');
        $dbPassword = $customer->password;
        $newPassword = $request->input('password');
        if ($oldPassword && $newPassword) {
            if (!Hash::check($oldPassword, $dbPassword)) {
                session()->put('error', 'Mật khẩu hiện tại chưa đúng');
                return redirect()->route('customer.show');
            }
            // Update password
            $customer->password = Hash::make($newPassword);
        }
        $customer->save();
        $request->session()->put('success', 'Cập nhật tài khoản thành công');
        return redirect()->route('customer.show');
    }

    function address() {
        $customer = Auth::user();
        $districts = [];
        $wards = [];
        $selected_ward = $customer->ward;
        $selected_province_id = null;
        $selected_district_id = null;
        $selected_ward_id = null;

        if (!empty($selected_ward)) {
            $selected_ward_id = $selected_ward->id; // 2 selected_ward_id
            $selected_district = $selected_ward->district;
            $selected_district_id = $selected_district->id; //3 selected_district_id
            $selected_province = $selected_district->province;
            $selected_province_id = $selected_province->id; //4 selected_province_id
            $districts = $selected_province->districts; // 5 districts
            $wards =  $selected_district->wards; //6 wards
        }

        $provinces = Province::all();

        $data = [
            'customer'  => $customer,
            'provinces' => $provinces,
            'districts' => $districts,
            'wards'     => $wards,
            "selected_province_id" => $selected_province_id,
            "selected_district_id" => $selected_district_id,
            "selected_ward_id"     => $selected_ward_id,
        ];

        return view('customer.address', $data);
    }

    function updateAddress(Request $request) {
        $customer = Auth::user();

        $customer->shipping_name = $request->input('fullname');
        $customer->shipping_mobile = $request->input('mobile');
        $customer->ward_id = $request->input('ward');
        $customer->housenumber_street = $request->input('address');

        $customer->save();
        $request->session()->put('success', 'Cập nhật địa chỉ giao hàng thành công');
        return redirect()->route('customer.address');
    }
}
