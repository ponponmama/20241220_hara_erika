<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Season;
use App\Models\Product;
use App\Http\Requests\RegisterProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Arr;

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
        return view('register');
    }

    //商品登録ページの処理
    public function store(RegisterProductRequest $request)
    {
        $validatedData = $request->validated();

        $seasonNames = $validatedData['season'];
        unset($validatedData['season']);

        $product = new Product($validatedData);
        if ($request->hasFile('image')) {
            $filename = $request->image->store('images', 'public');
            $product->image = $filename;
        }
        $product->save();

        $seasonIds = Season::whereIn('name', $seasonNames)->get()->pluck('id');
        foreach ($seasonIds as $seasonId) {
            $product->seasons()->attach($seasonId);
        }

        return redirect()->route('products.index')->with('success', '商品が登録されました。');
    }

    //詳細表示
    public function show($productId)
    {
        $product = Product::with('seasons')->findOrFail($productId);
        $seasons = Season::all();
        return view('product_detail', compact('product', 'seasons'));
    }

    // 商品削除
    public function delete($productId)
    {
        $product = Product::findOrFail($productId);
        $product->delete();

        return redirect()->route('products.index')->with('success', '商品が削除されました。');
    }

    // 商品更新
    public function update(UpdateProductRequest $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $validatedData = $request->validated();

        // 'season' データを除外して更新
        $dataToUpdate = Arr::except($validatedData, ['season']);
        $product->update($dataToUpdate);

        // 画像の更新処理
        if ($request->hasFile('image')) {
            $filename = $request->image->store('images', 'public');
            $product->image = $filename;
        }

        // season の更新
        if (isset($validatedData['season'])) {
            $product->seasons()->sync($validatedData['season']);
        }

        $product->save();

        return redirect()->route('products.index', ['productId' => $productId])->with('success', '商品情報が更新されました。');
    }
}