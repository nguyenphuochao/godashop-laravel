<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ViewProduct;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize("viewAny", Comment::class);

        $products = ViewProduct::all();

        return view("admin.comment.index", [
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
     * @param  Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $this->authorize("delete", $comment);

        $comment->delete();

        request()->session()->put("success", "Xóa thành công comment");

        return redirect()->back();
    }

    public function detail(Request $request)
    {
        $this->authorize("detail", Comment::class);

        $productId = $request->productId;

        $product = Product::findOrFail($productId);

        return view("admin.comment.detail", [
            'product' => $product
        ]);
    }

    public function deletes(Request $request, Comment $comment)
    {
        $this->authorize("delete", $comment);

        if(empty($request->ids)) {
            $request->session()->put("error", "Vui lòng chọn bình luận cần xóa!");
            return redirect()->back();
        }

        Comment::whereIn('id', $request->ids)->forceDelete();

        request()->session()->put("success", "Xóa thành công bình luận đã chọn!");

        return redirect()->back();
    }
}
