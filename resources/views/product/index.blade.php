@extends('layout.app')
@section('content')
    <main id="maincontent" class="page-main">
        <div class="container">
            <div class="row">
                <div class="col-xs-9">
                    <ol class="breadcrumb">
                        <li><a href="/" target="_self">Trang chủ</a></li>
                        <li><span>/</span></li>
                        <li class="active"><span>{{ $selectedCategoryName }}</span></li>
                    </ol>
                </div>
                <div class="col-xs-3 hidden-lg hidden-md">
                    <a class="hidden-lg pull-right btn-aside-mobile" href="javascript:void(0)">Bộ lọc <i
                            class="fa fa-angle-double-right"></i></a>
                </div>
                <div class="clearfix"></div>

                {{-- Sidebar --}}
                @include('layout.sidebar')

                {{-- Danh sách sản phẩm --}}
                <div class="col-md-9 products">
                    <div class="row equal">
                        <div class="col-xs-6">
                            <h4 class="home-title">{{ $selectedCategoryName }}</h4>
                        </div>
                        <div class="col-xs-6 sort-by">
                            @php
                                $sort = request()->has('sort') ? request()->input('sort') : null;
                            @endphp
                            <div class="pull-right">
                                <label class="left hidden-xs" for="sort-select">Sắp xếp: </label>
                                <select id="sort-select">
                                    <option value="" selected
                                        data-url="{{ trim(request()->fullUrlWithQuery(['sort' => null]), '?') }}"
                                        {{ $sort == '' ? 'selected' : '' }}>Mặc định</option>
                                    <option value="price-asc"
                                        data-url="{{ request()->fullUrlWithQuery(['sort' => 'price-asc']) }}"
                                        {{ $sort == 'price-asc' ? 'selected' : '' }}>Giá tăng dần</option>
                                    <option value="price-desc"
                                        data-url="{{ request()->fullUrlWithQuery(['sort' => 'price-desc']) }}"
                                        {{ $sort == 'price-desc' ? 'selected' : '' }}>Giá giảm dần</option>
                                    <option value="alpha-asc"
                                        data-url="{{ request()->fullUrlWithQuery(['sort' => 'alpha-asc']) }}"
                                        {{ $sort == 'alpha-asc' ? 'selected' : '' }}>Từ A-Z</option>
                                    <option value="alpha-desc"
                                        data-url="{{ request()->fullUrlWithQuery(['sort' => 'alpha-desc']) }}"
                                        {{ $sort == 'alpha-desc' ? 'selected' : '' }}>Từ Z-A</option>
                                    <option value="created-asc"
                                        data-url="{{ request()->fullUrlWithQuery(['sort' => 'created-asc']) }}"
                                        {{ $sort == 'created-asc' ? 'selected' : '' }}>Cũ đến mới</option>
                                    <option value="created-desc"
                                        data-url="{{ request()->fullUrlWithQuery(['sort' => 'created-desc']) }}"
                                        {{ $sort == 'created-desc' ? 'selected' : '' }}>Mới đến cũ</option>
                                </select>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        @foreach ($products as $product)
                            <div class="col-xs-6 col-sm-4">
                                @include('layout.product')
                            </div>
                        @endforeach

                    </div>
                    <!-- Paging -->
                    <div class="pagination pull-right">
                        {{ $products->links() }}
                    </div>
                    <!-- End paging -->
                </div>
            </div>
        </div>
    </main>
@endsection
