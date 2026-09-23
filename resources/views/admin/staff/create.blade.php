@extends('admin.layout.app')
@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">Quản lý</a>
                </li>
                <li class="breadcrumb-item active">Nhân viên</li>
            </ol>

            @include("admin.layout.message")

            <!-- /form -->
            <form method="post" action="{{route("admin.staff.store")}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="fullname">Họ Và Tên</label>
                    <div class="col-md-9 col-lg-6">
                        <input name="fullname" id="fullname" type="text" class="form-control" value="{{old("fullname")}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="username">Tên Đăng Nhập</label>
                    <div class="col-md-9 col-lg-6">
                        <input name="username" id="username" type="text" class="form-control" value="{{old("username")}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="password">Mật Khẩu</label>
                    <div class="col-md-9 col-lg-6">
                        <input name="password" id="password" type="password" class="form-control" autocomplete="new-password" >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="mobile">Số Điện Thoại</label>
                    <div class="col-md-9 col-lg-6">
                        <input name="mobile" id="mobile" type="text" class="form-control" value="{{old("mobile")}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="email">Email</label>
                    <div class="col-md-9 col-lg-6">
                        <input name="email" id="email" type="text" class="form-control" value="{{old("email")}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="role">Vai trò</label>
                    <div class="col-md-9 col-lg-6">
                        <select class="form-control" name="roleId">
                            <option value="">Vui lòng chọn</option>
                            @foreach ($roles as $role)
                                <option @if(old("roleId") == $role->id) selected @endif value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-action">
                    <input type="submit" class="btn btn-primary btn-sm" value="Lưu" name="save">
                </div>
            </form>
            <!-- /form -->
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
