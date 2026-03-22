<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ViewProduct;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Lấy sản phẩm nổi bật
        $featuredProducts = ViewProduct::orderBy("featured", "DESC")->take(4)->get();

        // Lấy sản phẩm mới nhất
        $latestProducts = ViewProduct::orderBy('created_date', 'DESC')->take(4)->get();

        // Lấy sản phẩm theo danh mục
        $categories = Category::all();
        $categoryProducts = [];
        foreach ($categories as $category) {
            $products = ViewProduct::where('category_id', $category->id)->take(4)->get();
            $categoryProducts[$category->name] = $products;
        }

        // Cách 2 use dynamic properties
        // foreach ($categories as $category) {
        //     $categoryProducts[$category->name] = $category->products->take(4)->all();
        // }

        $data = [
            "featuredProducts" => $featuredProducts,
            "latestProducts"   => $latestProducts,
            "categoryProducts"      => $categoryProducts
        ];

        return view('home.index', $data);
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
