<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Season;
use App\Models\Product;
use App\Http\Requests\RegisterProductRequest;

class ProductController extends Controller
{
     // 商品一覧（トップページ）
    public function index(Request $request)
    {
        // すべての商品を取得
        $products = Product::paginate(6);

        // 商品一覧ビューを表示
        return view('products', compact('products'));
    }
    
    //検索search
    public function search(Request $request)
    {
        $query = Product::query();

        // セッションから検索クエリを取得または更新
        if ($request->has('query')) {
            $searchTerm = $request->input('query');
            session(['search_query' => $searchTerm]);
        } else {
            $searchTerm = session('search_query', '');
        }

        // 検索クエリがある場合、それに基づいてフィルタリング
        if (!empty($searchTerm)) {
            $query->where('name', 'like', '%' . $searchTerm . '%');
        }

        // セッションから価格ソートオプションを取得または更新
        if ($request->has('price_search')) {
            $priceSearch = $request->input('price_search');
            session(['price_search' => $priceSearch]);
        } else {
            $priceSearch = session('price_search', '');
        }

        // 価格順のソート処理をクエリに適用
        if ($priceSearch == 'high_to_low') {
            $query->orderBy('price', 'desc');
        } elseif ($priceSearch == 'low_to_high') {
            $query->orderBy('price', 'asc');
        }

        $products = $query->paginate(6)->appends([
            'query' => request('query'),
            'price_search' => request('price_search')
        ]);

        return view('products', compact('products'));
    }

    // 商品登録ページを表示
    public function register()
    {
        return view('products.register');
    }

    //商品登録ページの処理
    public function store(RegisterProductRequest $request)
    {
        $validatedData = $request->validated();

        $seasonNames = $validatedData['season'];
        unset($validatedData['season']);

        $product = new Product($validatedData);
        if ($request->hasFile('image')) {
            $filename = $request->image->store('image', 'public');
            $product->image = $filename;
        }
        $product->save();

        $seasonIds = Season::whereIn('name', $seasonNames)->get()->pluck('id');
        foreach ($seasonIds as $seasonId) {
            $product->seasons()->attach($seasonId);
        }

        return redirect()->route('products.index')->with('success', '商品が登録されました。');
    }
    
}
