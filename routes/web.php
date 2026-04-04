<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('products.home');
})->name('home');

Route::get('/products', function () {
    return view('products.index');
})->name('products.index');

Route::get('/cart', function () {
    return view('cart.index');
})->name('cart.index');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/products/{id}', function ($id) {
    return view('products.show');
})->name('products.show');

Route::get('/checkout', function () {
    return view('checkout.index');
})->name('checkout.index');

Route::get('/order-success', function () {
    return view('checkout.success');
})->name('order.success');