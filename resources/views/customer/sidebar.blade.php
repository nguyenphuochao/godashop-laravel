@php
    $currentRouteName = Route::currentRouteName();
@endphp
<aside class="col-md-3">
    <div class="inner-aside">
        <div class="category">
            <ul>
                <li class="{{ $currentRouteName == 'customer.show' ? 'active' : '' }}">
                    <a href="{{ route('customer.show') }}" title="Thông tin tài khoản" target="_self">Thông tin tài khoản
                    </a>
                </li>
                <li class="{{ $currentRouteName == 'customer.address' ? 'active' : '' }}">
                    <a href="{{ route('customer.address') }}" title="Địa chỉ giao hàng mặc định" target="_self">Địa chỉ giao hàng mặc định
                    </a>
                </li>
                <li class="{{ in_array($currentRouteName, ['orders.index', 'orders.show']) ? 'active' : '' }}">
                    <a href="{{ route('orders.index') }}" target="_self">Đơn hàng của tôi
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>
