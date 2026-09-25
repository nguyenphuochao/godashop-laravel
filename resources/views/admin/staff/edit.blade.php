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
            <form method="post" action="{{route("admin.staff.update", $staff->id)}}" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="fullname">Họ Và Tên</label>
                    <div class="col-md-9 col-lg-6">
                        <input name="fullname" id="fullname" type="text" value="{{$staff->name}}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="username">Tên Đăng Nhập</label>
                    <div class="col-md-9 col-lg-6">
                        <input disabled name="username" id="username" type="text" value="{{$staff->username}}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="password">Mật Khẩu</label>
                    <div class="col-md-9 col-lg-6">
                        <input name="password" id="password" type="password" value="" class="form-control" autocomplete="new-password">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="mobile">Số Điện Thoại</label>
                    <div class="col-md-9 col-lg-6">
                        <input name="mobile" id="mobile" type="text" value="{{$staff->mobile}}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="email">Email</label>
                    <div class="col-md-9 col-lg-6">
                        <input disabled name="email" id="email" type="text" value="{{$staff->email}}"
                            class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="role">Vai trò</label>
                    <div class="col-md-9 col-lg-6">
                        <select class="form-control" name="roleId">
                            <option value="">Vui lòng chọn</option>
                            @foreach ($roles as $role)
                                <option @if($role->id == $roleStaff->role_id) selected @endif value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="is_active">Trạng thái</label>
                    <div class="col-md-9 col-lg-6">
                        <select class="form-control" name="is_active" id="is_active">
                           <option @if($staff->is_active == 1) selected @endif value="1">Hoạt động</option>
                           <option @if($staff->is_active == 0) selected @endif value="0">Khóa tài khoản</option>
                        </select>
                    </div>
                </div>
                <div class="form-action mb-3">
                    <input type="submit" class="btn btn-primary btn-sm" value="Cập nhật" name="edit">
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
