<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

//商品一覧画面の表示
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

//検索search
Route::get('/products/search', [ProductController::class,'search'])->name('products.search');

