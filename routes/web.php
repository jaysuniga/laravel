<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\CheckSellerAccount;
use App\Http\Controllers\CheckoutController;

Route::get('/',[UserController::class,'home'])->name('home');
Route::get('/shop',[UserController::class,'shop'])->name('shop');

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

Route::get('/register',[UserController::class,'register'])->name('register');
Route::post('/register',[UserController::class,'registerHandler'])->name('registerHandler');

Route::post('/logout',[UserController::class,'logout']);

Route::get('/login',[UserController::class,'login'])->name('login');
Route::post('/login',[UserController::class,'loginHandler'])->name('loginHandler');

Route::middleware(['auth'])->group(function () {
    Route::get('/sellers/dashboard', [SellerController::class, 'dashboard'])->name('sellers.dashboard')->middleware('checkSellerAccount');
    Route::get('/sellers/manage', [SellerController::class, 'manage'])->name('sellers.manage')->middleware('checkSellerAccount');
    Route::get('/sellers/orders', [SellerController::class, 'orders'])->name('sellers.orders')->middleware('checkSellerAccount');
    Route::patch('/orders/{order}/status', [SellerController::class, 'updateStatus'])->name('orders.updateStatus');


    Route::get('/sellers/registerSeller', [SellerController::class, 'registerSeller'])->name('sellers.registerSeller');
    Route::post('/sellers/registerSeller', [SellerController::class, 'registerHandler'])->name('sellers.registerHandler');


    Route::middleware([CheckSellerAccount::class])->group(function () {
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    });

    Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{cartItemId}', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::delete('/cart/delete/multiple', [CartController::class, 'deleteMultiple'])->name('cart.delete.multiple');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');

    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
});

