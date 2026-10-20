@extends('admin.layout.app')
@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">Quản lý</a>
                </li>
                <li class="breadcrumb-item active">Đánh giá</li>
            </ol>
            <!-- DataTables Example -->

            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Barcode</th>
                                    <th>Tên </th>
                                    <th>Hình ảnh</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($products as $product): ?>
                                <tr>
                                    <td>
                                        <a href="{{route('admin.comment.detail', array('productId' => $product->id))}}"><?= $product->barcode ?></a>
                                    </td>
                                    <td><?= $product->name ?></td>
                                    <td><img src="{{ asset("") }}images/{{$product->featured_image}}"></td>

                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
