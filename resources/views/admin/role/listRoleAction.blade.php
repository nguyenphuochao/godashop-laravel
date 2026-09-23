@extends('admin.layout.app')
@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Phân quyền</li>
                <li class="breadcrumb-item">
                    <a href="{{route("admin.role.index")}}">Vai trò</a>
                </li>
                <li class="breadcrumb-item">{{ $role->name }}</li>
                <li class="breadcrumb-item active">Tác vụ</li>
            </ol>
            <!-- DataTables Example -->

            <!-- /form -->
            <form method="post" action="{{route("admin.role.updateRoleAction", $role->id)}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    @foreach($actions as $action)
                    <div class="col-md-9 col-lg-6">
                        <input type="checkbox" {{ in_array($action->id, $selectedAction) ? "checked" : "" }}
                            name="action_ids[]" value="{{ $action->id }}">
                        {{ $action->description }}
                    </div>
                    @endforeach
                </div>
                <div class="form-action">
                    <input type="submit" class="btn btn-primary btn-sm" value="Cập nhật" name="update">
                </div>
            </form>
            <!-- /form -->
        </div>
    @endsection
