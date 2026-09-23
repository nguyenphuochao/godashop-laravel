<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = Auth::guard('admin')->user();
        if (!$staff->can('viewAny', Category::class)) {
            abort(403);
        }

        $categories = Category::all();
        return view("admin.category.index", ["categories" => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $staff = Auth::guard('admin')->user();
        if (!$staff->can('create', Category::class)) {
            abort(403);
        }

        return view("admin.category.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // authorization
        $staff = Auth::guard('admin')->user();
        if (!$staff->can('create', Category::class)) {
            abort(403);
        }

        // validate
        $request->validate([
            "name" => ["required"]
        ], [
            "name.required" => "Vui lòng nhập tên danh mục"
        ]);

        // save DB
        $category = new Category();
        $category->name = $request->name;
        $category->save();

        return redirect()->route('admin.category.index');
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
        $category = Category::findOrFail($id);

        $staff = Auth::guard('admin')->user();
        if (!$staff->can('update', $category)) {
            abort(403);
        }

        return view("admin.category.edit", ["category" => $category]);
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
        // read category by id, when invalid redirect 403 page
        $category = Category::findOrFail($id);

        $staff = Auth::guard('admin')->user();
        if (!$staff->can('update', $category)) {
            abort(403);
        }

        // validate
        $request->validate([
            "name" => "required|unique:categories,name," . $id
        ], [
            "name.required" => "Vui lòng nhập tên danh mục",
            "name.unique" => "Tên danh mục này trùng với danh mục đã tồn tại"
        ]);

        $category->name = $request->name;
        $category->save();

        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $staff = Auth::guard('admin')->user();
        if (!$staff->can('delete', $category)) {
            abort(403);
        }

        try {
            $category->forceDelete();
            request()->session()->put("success", "Xóa thành công danh mục");
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                request()->session()->put("error", "Danh mục đang chứa sản phẩm đăng kí, không thể xóa");
            } else {
                request()->session()->put("error", $e->getMessage());
            }
        }

        return redirect()->route('admin.category.index');
    }

    public function deletes(Category $category, Request $request)
    {
        $staff = Auth::guard('admin')->user();
        if (!$staff->can('delete', $category)) {
            abort(403);
        }

        if (empty($request->ids)) {
            $request->session()->put("error", "Vui lòng chọn danh mục cần xóa!");
            return redirect()->route('admin.category.index');;
        }

        try {
            Category::whereIn('id', $request->ids)->forceDelete();
            request()->session()->put("success", "Đã xóa danh mục thành công");
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                request()->session()->put("error", "Danh mục đang chứa sản phẩm đăng kí, không thể xóa");
            } else {
                request()->session()->put("error", $e->getMessage());
            }
        }

        return redirect()->route('admin.category.index');
    }
}
