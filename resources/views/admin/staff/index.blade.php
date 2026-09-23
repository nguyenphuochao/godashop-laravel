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
            <!-- DataTables Example -->
            <div class="action-bar">
                <a href="{{route("admin.staff.create")}}" class="btn btn-primary btn-sm">Thêm</a>
                <input type="submit" class="btn btn-danger btn-sm" value="Xóa" name="delete">
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" onclick="checkAll(this)"></th>
                                    <th>Tên </th>
                                    <th>Tên đăng nhập</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th> Vai trò </th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($staffs as $staff)
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td>{{$staff->name}}</td>
                                        <td>{{$staff->username}}</td>
                                        <td>{{$staff->email}}</td>
                                        <td>{{$staff->mobile}}</td>
                                        <td>
                                            @php
                                                foreach ($staff->roles as $key => $role) {
                                                   echo $role->name. "</br>";
                                                }
                                            @endphp
                                        </td>
                                        <td> <input type="button" onclick="Edit('1');" value="Sửa"
                                                class="btn btn-warning btn-sm"></td>
                                        <td><input type="button" onclick="Delete('1');" value="Xóa"
                                                class="btn btn-danger btn-sm"></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
