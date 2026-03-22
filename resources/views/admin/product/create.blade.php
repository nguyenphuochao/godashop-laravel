@extends('admin.layout.app')
@section('content')
    <div>
        <h1>Product Create</h1>
        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Upload image</label>
                <input type="file" class="form-control" name="featured_image">
            </div>
            <div>
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
