<ul class="sidebar navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="../../pages/dashboard/index.html"><i class="fas fa-fw fa-tachometer-alt"></i> <span>Tổng
                quan</span></a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i
                class="fas fa-shopping-cart"></i> <span>Đơn hàng</span></a>
        <div class="dropdown-menu" aria-labelledby="">
            <a class="dropdown-item" href="../../pages/order/list.html">Danh sách</a>
            <a class="dropdown-item" href="../../pages/order/add.html">Thêm</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i
                class="fab fa-product-hunt"></i> <span>Sản phẩm</span></a>
        <div class="dropdown-menu" aria-labelledby="">
            <a class="dropdown-item" href="../../pages/product/list.html">Danh sách</a>
            <a class="dropdown-item" href="../../pages/product/add.html">Thêm</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i
                class="fas fa-comments"></i> <span>Comment</span></a>
        <div class="dropdown-menu" aria-labelledby="">
            <a class="dropdown-item" href="../../pages/comment/list.html">Danh sách</a>
        </div>
    </li>

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i
                class="far fa-image"></i> <span>Hình ảnh</span></a>
        <div class="dropdown-menu" aria-labelledby="">
            <a class="dropdown-item" href="../../pages/image/list.html">Danh sách</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i
                class="fas fa-user-alt"></i> <span>Khách hàng</span></a>
        <div class="dropdown-menu" aria-labelledby="">
            <a class="dropdown-item" href="../../pages/customer/list.html">Danh sách</a>
            <a class="dropdown-item" href="../../pages/customer/add.html">Thêm</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i
                class="fas fa-folder"></i> <span>Danh mục</span></a>
        <div class="dropdown-menu" aria-labelledby="">
            <a class="dropdown-item" href="{{ route('admin.category.index') }}">Danh sách</a>
            <a class="dropdown-item" href="{{ route('admin.category.create') }}">Thêm</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i
                class="fas fa-percentage"></i> <span>Khuyến mãi</span></a>
        <div class="dropdown-menu" aria-labelledby="">
            <a class="dropdown-item" href="../../pages/promotion/list.html">Danh sách</a>
            <a class="dropdown-item" href="../../pages/promotion/add.html">Thêm</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i
                class="fas fa-shipping-fast"></i> <span>Phí giao hàng</span></a>
        <div class="dropdown-menu" aria-labelledby="">
            <a class="dropdown-item" href="../../pages/transport/list.html">Danh sách</a>
            <a class="dropdown-item" href="../../pages/transport/add.html">Thêm</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i
                class="fas fa-users"></i> <span>Nhân viên</span></a>
        <div class="dropdown-menu" aria-labelledby="">
            <a class="dropdown-item" href="{{ route('admin.staff.index') }}">Danh sách</a>
            <a class="dropdown-item" href="{{ route('admin.staff.create') }}">Thêm</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i
                class="fas fa-user-shield"></i> <span>Phân quyền</span></a>
        <div class="dropdown-menu" aria-labelledby="">
            <a class="dropdown-item" href="{{ route('admin.role.index') }}">Danh sách vai trò</a>
            <a class="dropdown-item" href="{{ route('admin.role.create') }}">Thêm vai trò</a>
            <a class="dropdown-item" href="../../pages/permission/actions.html">Danh sách tác vụ</a>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="../../pages/order_status/list.html"><i class="fas fa-star-half-alt"></i>
            <span>Trạng thái đơn hàng</span></a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i
                class="fas fa-file-alt"></i> <span>News letter</span></a>
        <div class="dropdown-menu" aria-labelledby="">
            <a class="dropdown-item" href="../../pages/newsletter/list.html">Danh sách</a>
            <a class="dropdown-item" href="../../pages/newsletter/send.html">Gởi mail</a>
        </div>
    </li>
</ul>
