<?php

use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Customer\AddressController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\ContactController as CustomerContactController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\Customer\DetailPaymentController;
use App\Http\Controllers\Customer\PaymentController as CustomerPaymentController;
use App\Http\Controllers\Customer\ProductController as CustomerProductController;
use App\Http\Controllers\General\AuthController;
use App\Http\Controllers\General\PageController;
use App\Http\Controllers\General\SearchController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// General Auth
Route::get('/', [PageController::class, 'index'])->name('general.index');
Route::get('/login', [PageController::class, 'login'])->name('general.auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('user.login');
Route::get('/register', [PageController::class, 'register'])->name('general.auth.register');
Route::post('/register', [AuthController::class, 'register'])->name('user.register');
Route::get('/logout', [AuthController::class, 'logout'])->name('user.logout');

Route::group(['middleware' => 'checklogin'], function () {
    // Admin Routes
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/contacts', [ContactController::class, 'index'])->name('admin.contact.index');
    Route::get('/admin/customers', [CustomerController::class, 'index'])->name('admin.customer.index');

    // Admin Payment Routes
    Route::get('/admin/payment', [PaymentController::class, 'index'])->name('admin.payment.index');
    Route::patch('/admin/payment/{transaction_payment_uuid}', [PaymentController::class, 'update'])->name('admin.payment.update');

    // Admin Contact Routes
    Route::get('/admin/contacts', [ContactController::class, 'index'])->name('admin.contact.index');
    Route::post('/admin/contacts', [ContactController::class, 'store'])->name('admin.contact.store');

    // Admin Product Routes
    Route::get('/admin/products/{product_uuid}', [ProductController::class, 'update_page'])->name('admin.product.update_page');
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.product.index');
    Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.product.store');
    Route::delete('/admin/products/{product_uuid}', [ProductController::class, 'delete'])->name('admin.product.delete');
    Route::patch('/admin/products/{product_uuid}', [ProductController::class, 'update'])->name('admin.product.update');

    // Customer Routes
    Route::get('/customer/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
    Route::get('/customer/contacts', [CustomerContactController::class, 'index'])->name('customer.contact');
    Route::get('/customer/products', [CustomerProductController::class, 'index'])->name('customer.product');
    Route::post('/customer/products/{product_uuid}', [CustomerProductController::class, 'store'])->name('customer.product.store');

    // Customer Cart Routes
    Route::get('/customer/cart', [CartController::class, 'index'])->name('customer.cart');
    Route::delete('/customer/cart/{cart_uuid}', [CartController::class, 'delete'])->name('customer.cart.delete');
    Route::patch('/customer/cart/{cart_uuid}/count', [CartController::class, 'countQuantity'])->name('customer.cart.countQuantity');

    // Customer Address Routes
    Route::get('/customer/address/{transaction_uuid}', [AddressController::class, 'index'])->name('customer.address');
    Route::post('/customer/address/checkongkir', [AddressController::class, 'checkOngkir'])->name('customer.address.checkOngkir');
    Route::post('/customer/address/{transaction_uuid}', [AddressController::class, 'store'])->name('customer.address.store');

    // Customer Detail Payment Routes
    Route::get('/customer/detail_payment/{transaction_uuid}', [DetailPaymentController::class, 'index'])->name('customer.detail_payment');
    Route::post('/customer/detail_payment', [DetailPaymentController::class, 'store'])->name('customer.detail_payment.store');

    // Customer Payment Routes
    Route::get('/customer/payment', [CustomerPaymentController::class, 'index'])->name('customer.payment');
    Route::patch('/customer/payment/{transaction_payment_uuid}', [CustomerPaymentController::class, 'update'])->name('customer.payment.update');

    // Search Controller
    Route::get('/customer/search/product', [SearchController::class, 'customerSearchProduct'])->name('customer.product.search');
    Route::get('/admin/search/product', [SearchController::class, 'adminSearchProduct'])->name('admin.product.search');
});