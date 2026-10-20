@extends('admin.layout.app')
@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">Quản lý</a>
                </li>
                <li class="breadcrumb-item active">Sản phẩm</li>
            </ol>

            @include("admin.layout.message")

            <!-- /form -->
            <form method="post" action="{{route("admin.product.update", ["product" => $product->id])}}" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="name">Barcode </label>
                    <div class="col-md-9 col-lg-6">
                        <input name="barcode" id="barcode" type="text" class="form-control" value="{{$product->barcode}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-12 control-label" for="name">SKU </label>
                    <div class="col-md-9 col-lg-6">
                        <input name="sku" id="sku" type="text" class="form-control"  value="{{$product->sku}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-12 control-label" for="name">Tên </label>
                    <div class="col-md-9 col-lg-6">
                        <input name="name" id="name" type="text" class="form-control" value="{{$product->name}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="wholesale-price">Giá bán lẻ </label>
                    <div class="col-md-9 col-lg-6">
                        <input name="wholesale_price" id="wholesale_price" type="number" value="{{$product->price}}"
                            class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-12 control-label" for="inventory-number">Lượng tồn</label>
                    <div class="col-md-9 col-lg-6">
                        <input name="inventory_number" id="inventory_number" type="text" value="{{$product->inventory_qty}}"
                            class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-12 control-label" for="category">Danh mục </label>
                    <div class="col-md-9 col-lg-6">
                        <select name="category" id="category" class="form-control">
                            <option value="">--Vui lòng chọn danh mục--</option>
                            @foreach (\App\Models\Category::all() as $cat)
                                <option @if($cat->id == $product->category_id) selected @endif value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-12 control-label" for="brand">Thương hiệu</label>
                    <div class="col-md-9 col-lg-6">
                        <select name="brand" id="brand" class="form-control">
                            <option value="">--Vui lòng chọn thương hiệu--</option>
                            @foreach (\App\Models\Brand::all() as $brand)
                                <option @if($brand->id == $product->brand_id) selected @endif value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-12 control-label">Nổi bật</label>
                    <div class="col-md-9 col-lg-6">
                        <input type="checkbox" value="1" name="featured" @if($product->featured == 1) checked @endif>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-12 control-label" for="featured_image">Hình ảnh </label>
                    <div class="col-md-9 col-lg-6">
                        <input type="file" name="featured_image" id="featured_image" value="123.jpg">
                        <br>
                        <img src="{{ asset("") }}images/{{$product->featured_image}}" alt="{{$product->name}}" width="200px">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-12 control-label" for="description">Mô tả</label>
                    <div class="col-md-12">
                        <textarea name="description" id="description" rows="10" cols="80">{!!$product->description!!}</textarea>
                    </div>
                </div>

                <div class="form-action">
                    <input type="submit" class="btn btn-primary btn-sm" value="Lưu" name="save">
                </div>

            </form>
            <script type="text/javascript" src="{{ asset("") }}adm/vendor/ckeditor/ckeditor.js"></script>
            <script>
                CKEDITOR.replace('description');
            </script>
            <!-- /form -->
        </div>
        <!-- /.content-wrapper -->
    </div>
@endsection
