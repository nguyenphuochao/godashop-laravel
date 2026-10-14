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
        $conds = [];

        // dd(date("Y-m-d 00:00:00"));

        if(in_array($request->order_date, ["today", ""])) {
            $conds[] = ["created_date", ">=", date("Y-m-d 00:00:00")];
            $conds[] = ["created_date", "<=", date("Y-m-d 23:59:59")];
        }

        if($request->order_date == "yesterday") {
            $conds[] = ["created_date", ">=", date("Y-m-d 00:00:00", strtotime("yesterday"))];
            $conds[] = ["created_date", "<=", date("Y-m-d 23:59:59", strtotime("yesterday"))];
        }

        if($request->order_date == "this-week") {
            $conds[] = ["created_date", ">=", date("Y-m-d 00:00:00", strtotime("monday this week"))];
            $conds[] = ["created_date", "<=", date("Y-m-d 23:59:59")];
        }

        if($request->order_date == "this-month") {
            $conds[] = ["created_date", ">=", date("Y-m-01 00:00:00")];
            $conds[] = ["created_date", "<=", date("Y-m-d 23:59:59")];
        }

        if($request->order_date == "3-month") {
            $conds[] = ["created_date", ">=", date("Y-m-1 00:00:00", strtotime("-3 months"))];
            $conds[] = ["created_date", "<=", date("Y-m-d 23:59:59")];
        }

        if($request->order_date == "this-year") {
            $conds[] = ["created_date", ">=", date("Y-01-01 00:00:00")];
            $conds[] = ["created_date", "<=", date("Y-m-d 23:59:59")];
        }

        if($request->order_date == "custom-date") {
            $conds[] = ["created_date", ">=", $request->from_date ." 00:00:00"];
            $conds[] = ["created_date", "<=", $request->to_date . " 23:59:59"];
        }

        $orders = Order::where($conds)->get();

        $data = [
            "orders" => $orders
        ];

        return view('admin.dashboard.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
