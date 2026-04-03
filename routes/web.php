<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home');
Route::view('/products', 'products.index');
Route::view('/cart', 'cart.index');
Route::view('/login', 'auth.login');
Route::view('/register', 'auth.register');