<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\FacebookController;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('index');
// Sản phẩm
Route::get('san-pham', [ProductController::class, 'index'])->name('product.index');
// Danh mục
Route::get('danh-muc/{slug}', [ProductController::class, 'index'])->name('category.show');
// Chi tiết sản phẩm
Route::get('san-pham/{slug}.html', [ProductController::class, 'show'])->name('product.show');
// Tìm kiếm sản phẩm bằng ajax
Route::get('san-pham/search', [ProductController::class, 'search'])->name('product.search');
// Bình luận sản phẩm bằng ajax
Route::post('comment/store', [CommentController::class, 'store'])->name('comment.store');

Route::post('register', [RegisterController::class, 'register'])->name('register');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('existingEmail', [RegisterController::class, 'existingEmail'])->name('existingEmail');

// Giỏ hàng
// Route::middleware("auth")->group(function () {

Route::get('carts/add', [CartController::class, 'add'])->name('cart.add');
Route::get('carts/show', [CartController::class, 'show'])->name('cart.show');
Route::get('carts/delete/{rowId}', [CartController::class, 'delete'])->name('cart.delete');
Route::get('carts/update/{rowId}/{qty}', [CartController::class, 'update'])->name('cart.update');
Route::get('carts/discount', [CartController::class, 'discount'])->name('cart.discount');
Route::get('carts/voucher', [CartController::class, 'voucher'])->name('cart.voucher');

// thanh toán
Route::get('payment/checkout', [PaymentController::class, 'create'])->name('payment.create');
Route::post('payment/store', [PaymentController::class, 'store'])->name('payment.store');

// phường, quận huyện ajax
Route::get('address/{provinceId}/districts', [AddressController::class, 'districts']);
Route::get('address/{districtId}/wards', [AddressController::class, 'wards']);
Route::get('shippingfree/{provinceId}', [AddressController::class, 'shippingfree']);

// form mail contact
Route::get('lien-he.html', [ContactController::class, 'show'])->name('contact.show');
// ajax gửi mail liên hệ
Route::post('sendmail', [ContactController::class, 'sendEmail'])->name('contact.sendmail');

// reset password
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Login google
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name("google.login");
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Login facebook
Route::get('auth/facebook', [FacebookController::class, 'redirectToFacebook'])->name("facebook.login");
Route::get('auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);

// Verify email
Route::get('email/verify/{id}/{hash}', [RegisterController::class, 'verify'])->name('verification.verify');

// });

// Thông tin customer sau khi login
Route::middleware("auth")->group(function () {
    Route::get('customer/show', [CustomerController::class, 'show'])->name('customer.show');
    Route::post('customer/update', [CustomerController::class, 'update'])->name('customer.update');
    Route::get('customer/address', [CustomerController::class, 'address'])->name('customer.address');
    Route::post('customer/updateAddress', [CustomerController::class, 'updateAddress'])->name('customer.address.update');
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{orderId}', [OrderController::class, 'show'])->name('orders.show');
});

// Trả về view lun khỏi cần tạo qua controller
Route::view('chinh-sach-doi-tra', 'return_policy.index')->name('return_policy.index');
Route::view('chinh-sach-thanh-toan', 'payment_policy.index')->name('payment_policy.index');
Route::view('chinh-sach-giao-hang', 'delivery_policy.index')->name('delivery_policy.index');

// Area Admin
Route::get('password-render', function () {
    echo Hash::make('123456');
});

Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->group(function () {
    Route::get('login', 'LoginController@index')->name('admin.login.form');
    Route::post('login', 'LoginController@login')->name('admin.login');
    Route::post('logout', 'LoginController@logout')->name('admin.logout');

    Route::middleware(['authAdmin:admin'])->group(function () {
        // dashboard
        Route::get('/', 'DashboardController@index')->name('dashboard');
        // category
        Route::get('category', 'CategoryController@index')->name('admin.category.index');
        Route::get('category/create', 'CategoryController@create')->name('admin.category.create');
        // product
        Route::get('product/create', 'ProductController@create')->name('admin.product.create');
        Route::post('product/store', 'ProductController@store')->name('admin.product.store');
    });
});
