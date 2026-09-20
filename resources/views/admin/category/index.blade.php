@extends('admin.layout.app')
@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">Quản lý</a>
                </li>
                <li class="breadcrumb-item active">Danh mục</li>
            </ol>

            {{-- show error message alert --}}
            @include('admin.layout.message')

            <!-- DataTables Example -->
            <form method="post" action="{{ route('admin.category.deletes') }}">
                @csrf
                <div class="action-bar">
                    <a href="{{route("admin.category.create")}}" class="btn btn-primary btn-sm">Thêm</a>
                    <input type="submit" class="btn btn-danger btn-sm" value="Xóa" name="delete">
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" onclick="checkAll(this)"></th>
                                        <th>Tên</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($categories as $category): ?>
                                    <tr>
                                        <td><input type="checkbox" name="ids[]" value="{{ $category->id }}"></td>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.category.edit', $category->id) }}"
                                                class="btn btn-warning btn-sm">
                                                Sửa
                                            </a>
                                        <td>
                                            <form method="post"
                                                action="{{ route('admin.category.destroy', $category->id) }}"
                                                id="formDelete">
                                                @csrf
                                                <button type="button" onclick="if(confirm('Bạn chắc xóa sản phẩm này?')) document.getElementById('formDelete').submit()"
                                                    class="btn btn-danger btn-sm">
                                                    Xóa
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </form>
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
