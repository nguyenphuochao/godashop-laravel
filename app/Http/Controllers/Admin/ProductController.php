<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ProductController extends Controller
{
    protected $productService;

    // Dependency injection via constructor
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // authorization
        $this->authorize("viewAny", Product::class);

        $products = $this->productService->getAll();
        return view("admin.product.index", [
            "products" => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // authorization
        $this->authorize("create", Product::class);

        // return view
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        // authorization
        $this->authorize("create", Product::class);

        if (!$request->hasFile('featured_image')) {
            echo 'File hình bị lỗi';
            exit;
        }

        // Cấu hình trong filesystems.php
        $filename = $request->file('featured_image')->getClientOriginalName();
        $request->file('featured_image')->storeAs(
            'images', $filename, 'godapublic'
        );

        $data = $request->all();
        $data["featured_image"] = $filename;

        // call product service -> create product
        $product = $this->productService->create($data);

        // return
        request()->session()->put("success", "Thêm mới thành công sản phẩm ". $product->name);
        return redirect()->route("admin.product.index");
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
        $product = $this->productService->edit($id);

        return view("admin.product.edit", [
            "product" => $product
        ]);
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

    public function deletes(Product $product, Request $request)
    {
        // authorization
        $this->authorize("delete", $product);

        if (empty($request->ids)) {
            $request->session()->put("error", "Vui lòng chọn sản phẩm cần xóa!");
            return redirect()->route('admin.product.index');;
        }

       $this->productService->deleteSelected($request->ids);

        request()->session()->put("success", "Đã xóa sản phẩm thành công");
        return redirect()->route('admin.product.index');
    }

    public function exportCSV(Request $request)
    {
        $this->productService->export($request->ids);
    }

    public function formImportCSV()
    {
        return view("admin.product.formImport");
    }

    public function importCSV()
    {
        // validate file invalid

        $this->productService->import(request()->file('excel'));

        request()->session()->put("success", "Import file data thành công");
        return redirect()->route("admin.product.index");
    }
}
