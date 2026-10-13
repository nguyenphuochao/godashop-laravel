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

            <!-- DataTables Example -->
            <div class="action-bar">
                <a href="{{route("admin.product.create")}}" class="btn btn-primary btn-sm" name="add">Thêm</a>
                <input type="button" data-url="{{route("admin.product.deletes")}}" class="btn btn-danger btn-sm action" value="Xóa" name="delete">

                <div class="dropdown" style="display: inline-block">
                    <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Xuất CSV
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item action" data-url="{{route("admin.product.exportCSV")}}">Tất cả</a>
                        <a class="dropdown-item action disabled" tabindex="-1" data-url="{{route("admin.product.exportCSV")}}" id="selectedExport">Các mục đã chọn</a>
                    </div>
                </div>
                <a href="{{route("admin.product.formImportCSV")}}" class="btn btn-info btn-sm" id="exportCsv">Nhập CSV</a>
            </div>

            <form action="#" id="formProduct" method="post">
                @csrf
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" onclick="checkAll(this)"></th>
                                        <th>Mã</th>
                                        <th style="width:50px">Tên </th>
                                        <th>Hình ảnh</th>
                                        <th>Giá bán lẻ</th>
                                        <th>% giảm giá</th>
                                        <th>Giá bán thực tế</th>
                                        <th>Lượng tồn</th>
                                        <th>Đánh giá</th>
                                        <th>Nội bật</th>
                                        <th>Danh mục</th>
                                        <th>Ngày tạo</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>

                                            <td><input type="checkbox" name="ids[]" value="{{$product->id}}"></td>
                                            <td>#{{$product->id}}</td>
                                            <td>{{$product->name}}</td>
                                            <td><img src="../../images/{{$product->featured_image}}"></td>
                                            <td>{{$product->price}} ₫</td>
                                            <td>{{$product->discount_percentage}}%</td>
                                            <td>{{$product->sale_price}} ₫</td>
                                            <td>{{$product->inventory_qty}}</td>
                                            <td>{{$product->star}}</td>
                                            <td>{{$product->featured === 1 ? "Có" : ""}}</td>
                                            <td>{{$product->category->name}} </td>
                                            <td>{{$product->created_date}}</td>
                                            <td><a href="../../pages/comment/list.html">Đánh giá</a></td>
                                            <td><a href="../../pages/image/list.html">Hình ảnh</a></td>
                                            <td><input type="button" onclick="Edit('25');" value="Sửa"
                                                    class="btn btn-warning btn-sm"></td>
                                            <td><input type="button" onclick="Delete('25');" value="Xóa"
                                                    class="btn btn-danger btn-sm"></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection

@push('custom-script')
    <script>

        $('.action').click(function(e){
            e.preventDefault();

            const action = $(this).attr("data-url");
            $("#formProduct").attr("action", action)
            $("#formProduct").submit();
        });

        $('input[name="ids[]"]').change(function() {
            if($('input[name="ids[]"]:checked').length > 0) {
                $("#selectedExport").removeClass("disabled");
            } else {
                $("#selectedExport").addClass("disabled");
            }
        })

    </script>
@endpush


