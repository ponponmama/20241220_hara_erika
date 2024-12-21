<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
     // 商品一覧（トップページ）
    public function index()
    {
        return view('products');
    }
}
