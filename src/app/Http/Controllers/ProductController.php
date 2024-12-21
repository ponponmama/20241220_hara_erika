<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Season;
use App\Models\Product;

class ProductController extends Controller
{
     // 商品一覧（トップページ）
    public function index()
    {
        $products = Product::all();
        $seasons = Season::all();
        return view('products', compact('seasons','products'));
    }
    //検索search
    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'like', '%' . $query . '%')->get();
        return view('products.index', compact('products'));
    }
}
