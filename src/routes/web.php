<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

//商品一覧画面の表示
Route::get('/products', [ProductController::class, 'index']);
//検索searchのform
Route::get('/products/search', 'ProductController@search')->name('products.search');
