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

            @include("admin.layout.message")

            <!-- DataTables Example -->
            <div class="action-bar">
                <a href="{{route("admin.role.create")}}" class="btn btn-primary btn-sm">Thêm</a>
                <input type="submit" class="btn btn-danger btn-sm" value="Xóa" name="delete">
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" onclick="checkAll(this)">
                                    <th>Tên </th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td>{{$role->name}}</td>
                                        <td>
                                            <a href="{{route("admin.role.edit", $role->id)}}" class="btn btn-warning btn-sm">Sửa</a>
                                        </td>
                                        <td>
                                            <input type="button" onclick="Delete('1');" value="Xóa"
                                                class="btn btn-danger btn-sm">
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="{{route("admin.role.listRoleAction", $role->id)}}">Cấp quyền</a>
                                        </td>
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
