<?php

use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Auth\RegisterController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\WishListController;
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

Route::middleware(['guest'])->group(function () {
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'index')->name('user.register');
        Route::post('/register', 'create')->name('user.make.register');
    });

    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'index')->name('user.login');
        Route::post('/login', 'login')->name('user.make.login');
    });
});



Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('user.home');
    Route::get('/product-details/{slug}', 'product_details')->name('user.product_details');
    Route::get('/shop', 'shop')->name('user.shop');
    Route::get('/price/product', 'product_by_price')->name('user.product.price');
    Route::get('/category', 'category')->name('user.category');
    Route::get('/search', 'search_product')->name('user.search.product');
    Route::get('/category/product/{slug}', 'product_by_category')->name('user.category.product');
    Route::get('/brand/product/{slug}', 'product_by_brand')->name('user.brand.product');
    Route::get('/brand', 'brands')->name('user.brand');
    Route::get('/shop/category/{id}', 'product_by_category')->name('user.shop.category');
    Route::get('/shop/category/{id}/{cat_id}', 'product_by_sub_category')->name('user.shop.sub.category');
    Route::get('/shop/category/{id}/{cat_id}/{sub_id}', 'product_by_child_category')->name('user.shop.child.category');
    Route::middleware(['auth'])->group(function () {
        Route::get('/add_to_wishlist/{id}', 'add_to_wishlist')->name('user.add_to_wishlist');
        Route::get('/add_to_compare/{id}', 'add_to_compare')->name('user.add_to_compare');
        Route::get('/add_to_cart/{id}', 'add_to_cart')->name('user.add_to_cart');
    });
});
Route::middleware(['auth'])->group(function () {
    Route::controller(CartController::class)->group(function () {
        Route::get('/cart', 'index')->name('user.cart');
        Route::get('/cart/clear', 'clearCart')->name('user.cart.clear');
        Route::post('/cart/update', 'update_cart')->name('user.cart.update');
        Route::get('/cart/remove/{id}', 'removeCartItem')->name('user.cart.remove');
    });
    Route::controller(WishListController::class)->group(function () {
        Route::get('/wishlist', 'index')->name('user.wishlist');
        Route::get('/wishlist/clear', 'clear_wishlist')->name('user.wishlist.clear');
        Route::get('/wishlist/remove/{id}', 'remove_wishlist')->name('user.wishlist.remove');
    });
    Route::controller(CheckoutController::class)->group(function () {
        Route::get('/checkout', 'index')->name('user.checkout');
        Route::post('/billing/address', 'update_billing_address')->name('user.billing_address');
        Route::get('/payment', 'payment')->name('user.payment');
        Route::get('/order', 'order')->name('user.order');
        Route::post('/checkout/cash-on-delivery', 'checkout_submit_cash_on_delivery')->name('user.checkout.cash.on.delivery');
    });
});

require_once 'admin.php';
