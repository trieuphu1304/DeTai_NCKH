<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProductsController;
use App\Http\Controllers\Backend\ProductCategoryController;
use App\Http\Controllers\Backend\UsersController;
use App\Http\Controllers\Backend\OrdersController;
use App\Http\Controllers\Backend\RevenueController;
use App\Http\Controllers\Fontend\ShopController;
use App\Http\Controllers\Fontend\CategoryController;
use App\Http\Controllers\Fontend\ContactController;
use App\Http\Controllers\Fontend\ViewBlogController;
use App\Http\Controllers\Fontend\AuthFontendController;
use App\Http\Controllers\Fontend\CartController;
use App\Http\Controllers\Fontend\CheckoutController;
use App\Http\Controllers\Fontend\ProductDetailController;
use App\Http\Controllers\Fontend\RegisterController;
use App\Http\Middleware\AuthenticateMiddleware;


/* Route Backend */
Route::get('admin', [AuthController::class, 'admin'])->name('auth.admin');
Route::post('login', [AuthController::class, 'login'])->name('auth.login');
Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('dashboard/layout', [DashboardController::class, 'layout'])->name('dashboard.layout')->middleware(AuthenticateMiddleware::class);
/* Users */
Route::get('users/index', [UsersController::class, 'index'])->name('users.index')->middleware(AuthenticateMiddleware::class);
Route::get('users/create', [UsersController::class, 'create'])->name('users.create')->middleware(AuthenticateMiddleware::class);
Route::post('users', [UsersController::class, 'store'])->name('users.store')->middleware(AuthenticateMiddleware::class);
Route::get('users/edit/{id}', [UsersController::class, 'edit'])->name('users.edit')->middleware(AuthenticateMiddleware::class);
Route::post('users/update/{id}', [UsersController::class, 'update'])->name('users.update')->middleware(AuthenticateMiddleware::class);
Route::delete('users/delete/{id}', [UsersController::class, 'delete'])->name('users.delete')->middleware(AuthenticateMiddleware::class);

/* Blog */ 
Route::get('blog/index', [BlogController::class, 'index'])->name('blog.index')->middleware(AuthenticateMiddleware::class);
Route::get('blog/create', [BlogController::class, 'create'])->name('blog.create')->middleware(AuthenticateMiddleware::class);
Route::post('blog', [BlogController::class, 'store'])->name('blog.store')->middleware(AuthenticateMiddleware::class);
Route::get('blog/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit')->middleware(AuthenticateMiddleware::class);
Route::post('blogy/update/{id}', [BlogController::class, 'update'])->name('blog.update')->middleware(AuthenticateMiddleware::class);
Route::delete('blog/delete/{id}', [BlogController::class, 'delete'])->name('blog.delete')->middleware(AuthenticateMiddleware::class);
/* ProductCategory */
Route::get('productcategory/index', [ProductCategoryController::class, 'index'])->name('productcategory.index')->middleware(AuthenticateMiddleware::class);
Route::get('productcategory/create', [ProductCategoryController::class, 'create'])->name('productcategory.create')->middleware(AuthenticateMiddleware::class);
Route::post('productcategory', [ProductCategoryController::class, 'store'])->name('productcategory.store')->middleware(AuthenticateMiddleware::class);
Route::get('productcategory/edit/{id}', [ProductCategoryController::class, 'edit'])->name('productcategory.edit')->middleware(AuthenticateMiddleware::class);
Route::post('productcategory/update/{id}', [ProductCategoryController::class, 'update'])->name('productcategory.update')->middleware(AuthenticateMiddleware::class);
Route::delete('productcategory/delete/{id}', [ProductCategoryController::class, 'delete'])->name('productcategory.delete')->middleware(AuthenticateMiddleware::class);
/* Products */
Route::get('products/index', [ProductsController::class, 'index'])->name('products.index')->middleware(AuthenticateMiddleware::class);
Route::get('products/create', [ProductsController::class, 'create'])->name('products.create')->middleware(AuthenticateMiddleware::class);
Route::post('products', [ProductsController::class, 'store'])->name('products.store')->middleware(AuthenticateMiddleware::class);
Route::get('products/edit/{id}', [ProductsController::class, 'edit'])->name('products.edit')->middleware(AuthenticateMiddleware::class);
Route::post('products/update/{id}', [ProductsController::class, 'update'])->name('products.update')->middleware(AuthenticateMiddleware::class);
Route::delete('products/delete/{id}', [ProductsController::class, 'delete'])->name('products.delete')->middleware(AuthenticateMiddleware::class);
/* Oders */ 
Route::get('orders/index', [OrdersController::class, 'index'])->name('orders.index')->middleware(AuthenticateMiddleware::class);
Route::get('oders/edit/{id}', [OrdersController::class, 'edit'])->name('orders.edit')->middleware(AuthenticateMiddleware::class);
Route::post('orders/update/{id}', [OrdersController::class, 'update'])->name('orders.update')->middleware(AuthenticateMiddleware::class);
Route::delete('oders/delete/{id}', [OrdersController::class, 'delete'])->name('orders.delete')->middleware(AuthenticateMiddleware::class);
/* Revenue */
Route::get('revenue/index',[RevenueController::class, 'index'])->name('revenue.index')->middleware(AuthenticateMiddleware::class);

/* Route Fontend */

/* Index */ 
Route::get('shop', [ShopController::class, 'index'])->name('shop.index');
/* Product Category */
Route::get('category', [CategoryController::class, 'index'])->name('category.index');
/* Blog */
Route::get('viewblog', [ViewBlogController::class, 'index'])->name('viewblog.index');
/* Contact */
Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
/* Login/ Logout */
Route::get('login', [AuthFontendController::class, 'index'])->name('login.index');
Route::post('authfontend.login', [AuthFontendController::class, 'login'])->name('authfontend.login');
Route::get('authfontend.logout', [AuthFontendController::class, 'logout'])->name('authfontend.logout');
/* Register */ 
Route::get('index', [RegisterController::class, 'index'])->name('register.index');
Route::post('register', [RegisterController::class, 'register'])->name('register');
/* Product Detail */
Route::get('product/{id}',[ProductDetailController::class, 'index'])->name('productdetail.index');
/* Cart */
Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::post('cart/add', [CartController::class, 'addCart'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
/* Checkout */ 
Route::get('checkout',[CheckoutController::class, 'index'])->name('checkout.index');
Route::post('checkout', [CheckoutController::class, 'checkout'])->name('checkout')->middleware('auth');
Route::get('confirm',[CheckoutController::class, 'confirm'])->name('checkout.confirm'); 