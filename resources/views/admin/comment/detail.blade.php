@extends('admin.layout.app')
@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">Quản lý</a>
                </li>
                <li class="breadcrumb-item ">Đánh giá</li>
                <li class="breadcrumb-item active"><?= $product->name ?></li>
            </ol>

            @include("admin.layout.message")

            <!-- DataTables Example -->
            <div class="action-bar">
                <label style="cursor: pointer;" for="delete" class="btn btn-danger btn-sm">Xóa</label>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="index.php?c=comment&a=deletes" method="POST">
                            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" onclick="checkAll(this)"></th>
                                        <th>Email</th>
                                        <th>Tên </th>
                                        <th>Số sao</th>
                                        <th>Ngày tạo</th>
                                        <th>Nội dung</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($product->comments as $comment): ?>
                                    <tr>
                                        <td><input type="checkbox" name="ids[]" value="<?= $comment->id ?>"></td>
                                        <td><?= $comment->email ?></td>
                                        <td><?= $comment->fullname ?></td>
                                        <td><?= $comment->star ?></td>
                                        <td><?= $comment->created_date ?></td>
                                        <td><?= $comment->description ?></td>
                                        <td>
                                            <a data-url="{{ route('admin.comment.destroy', ['comment' => $comment->id]) }}"
                                                class="btn btn-danger text-light delete">Xóa
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </form>

                        {{-- Form delete comment --}}
                        <form action="#" method="POST" id="formDeleteComment">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-script')

    <script>
        $(".delete").click(function (e) {
            e.preventDefault();

            if(!confirm('Bạn muốn xóa comment này hok?')) return;

            const action = $(this).attr("data-url");
            $("#formDeleteComment").attr("action", action);
            $("#formDeleteComment").submit();
        });
    </script>

@endpush
