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

            @include('admin.layout.message')

            <!-- /form -->

            <form action="{{ route('admin.product.importCSV') }}"
                class="container-fluid"
                style="max-width: 500px"
                enctype="multipart/form-data"
                method="POST">
                @csrf

                <h1>Upload file excel</h1>

                <div class="form-group">
                    <input class="form-control" type="file" id="excel" name="excel">
                </div>

                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <!-- /form -->
        </div>
    </div>
@endsection
