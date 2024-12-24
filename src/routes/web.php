<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

//商品一覧画面の表示
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

//検索search
Route::get('/products/search', [ProductController::class,'search'])->name('products.search');

// 商品登録ページを表示するためのルート
Route::get('/products/register', [ProductController::class, 'register'])->name('products.register');

// 商品登録処理を行うルート
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');

