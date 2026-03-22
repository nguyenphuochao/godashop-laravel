<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    public function districts($province_id)
    {
        // cách 1
        // $districts = District::where("province_id", $province_id)->get();

        // cách 2
        $province = Province::find($province_id);
        $districts = $province->districts;
        $arr = [];
        foreach ($districts as $district) {
            $arr[] = ["id" => $district->id, "name" => $district->name];
        }
        return json_encode($arr);
    }

    public function wards($district_id)
    {
        $district = District::find($district_id);
        $wards = $district->wards;
        $arr = [];
        foreach ($wards as $ward) {
            $arr[] = ["id" => $ward->id, "name" => $ward->name];
        }
        return json_encode($arr);
    }

    /**
     * Retrieve and display the shipping fee for a given province.
     *
     * @param int $province_id The ID of the province for which to retrieve the shipping fee.
     * @return void
     */
    public function shippingfree($province_id)
    {
        $shippingfee = DB::table('transports')->where('province_id', $province_id)->first();
        echo $shippingfee->price;
    }
}
