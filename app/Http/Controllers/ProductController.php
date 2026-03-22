<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ViewProduct;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($categorySlug = null, Request $request)
    {
        $catId = null;
        $selectedCategoryName = "Tất cả sản phẩm";
        $conds = []; // điều kiện để query

        // hiển thị sản phẩm theo danh mục
        if ($categorySlug) {
            $tmp = explode('-', $categorySlug);
            $catId = array_pop($tmp);
            $selectedCategoryName = Category::find($catId)->name;
            $conds[] = ["category_id", "=", $catId];
        }

        // lọc sản phẩm theo khoảng giá
        if ($request->has("price-range")) {
            // price-range=100000-200000
            $priceRange = $request->input("price-range");
            $tmp = explode("-", $priceRange);
            $start = $tmp[0];
            $end = $tmp[1];
            $conds[] = ["sale_price", ">=", $start];
            // WHERE sale_price >= 100000
            // bởi vì price-range=1000000-greater
            if (is_numeric($end)) {
                $conds[] = ["sale_price", "<=", $end];
            }
        }

        // sắp xếp sản phẩm theo tiêu chí
        $col = 'name';
        $sortType = "ASC";
        if ($request->has("sort")) {
            // sort=price-asc
            $sort = $request->input('sort');
            $colMap = ['alpha' => 'name', 'created' => 'created_date', 'price' => 'sale_price'];
            $temp = explode('-', $sort);
            $col = $colMap[$temp[0]];
            $sortType = $temp[1];
        }

        // Tìm kiếm sản phẩm theo tên
        if ($request->has('search')) {
            $search = $request->input('search');
            $conds[] = ["name", "like", "%$search%"];
        }

        $itemPerPage = env('ITEM_PER_PAGE', 12);
        $products = ViewProduct::where($conds)->orderBy($col, $sortType)->paginate($itemPerPage)->withQueryString();
        $categories = Category::all();

        $data = [
            'products' => $products,
            'categories' => $categories,
            'catId' => $catId,
            'selectedCategoryName' => $selectedCategoryName
        ];

        return view('product.index', $data);
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
    public function show($slug)
    {
        $tmp = explode('-', $slug);
        $id = array_pop($tmp);

        $product = ViewProduct::find($id);
        $categories = Category::all();

        $data = [
            'product' => $product,
            'categories' => $categories,
            'catId' => $product->category_id
        ];

        return view('product.show', $data);
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

    // Tìm kiếm sản phẩm theo tên bằng ajax
    public function search(Request $request)
    {
        $search = $request->input("pattern");
        $conds = [];
        $conds[] = ["name", "LIKE", "%$search%"];
        $products = ViewProduct::where($conds)->get();
        return view('product.search', ["products" => $products]);
    }
}
