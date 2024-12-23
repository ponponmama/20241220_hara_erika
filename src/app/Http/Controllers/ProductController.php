<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Season;
use App\Models\Product;

class ProductController extends Controller
{
     // 商品一覧（トップページ）
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('price_search')) {
            if ($request->price_search == 'high_to_low') {
                $query->orderBy('price', 'desc');
            } elseif ($request->price_search == 'low_to_high') {
                $query->orderBy('price', 'asc');
            }
        }

        $products = $query->paginate(6);

        return view('products', compact('products'));
    }
    
    //検索search
    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'like', '%' . $query . '%')->paginate(6);

        return view('products', compact('products'));
    }
    
}
