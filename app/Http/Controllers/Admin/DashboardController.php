<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = $request->type;
        $from_date = (!empty($request->from_date) ? $request->from_date : date("Y-m-d")) . " 00:00:00";
        $to_date = (!empty($request->to_date) ? $request->to_date : date("Y-m-d")) . " 23:59:59";

        $conds = [
            ["created_date", ">=", $from_date],
            ["created_date", "<=", $to_date]
        ];

        $orders = Order::where($conds)->get();

        $data = [
            "orders" => $orders,
            "type"   => $type
        ];

        return view('admin.dashboard.index', $data);
    }
}
