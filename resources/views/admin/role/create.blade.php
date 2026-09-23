@extends('admin.layout.app')
@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">Quản lý</a>
                </li>
                <li class="breadcrumb-item active">Vai trò</li>
            </ol>
            <!-- /form -->
            <form class="form-horizontal" method="post" action="{{route("admin.role.store")}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="name">Tên</label>
                    <div class="col-md-9 col-lg-6">
                        <input name="name" id="name" type="text" value="" class="form-control">
                    </div>
                </div>
                <div class="form-action">
                    <input type="submit" class="btn btn-primary btn-sm" value="Lưu" name="save">
                </div>
            </form>
            <!-- /form-->
        </div>
        <!-- /.container-fluid -->
        <!-- Sticky Footer -->
        <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright © Thầy Lộc 2017</span>
                </div>
            </div>
        </footer>
    </div>
@endsection
