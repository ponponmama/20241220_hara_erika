@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
<div class="product">
    <div class="products-search">
        <h2 class="products-heading">商品一覧</h2>
        <form action="{{ route('products.search')}}" method="GET">
            <input class="search_form" type="text" placeholder="商品名で検索">
            <button type="submit" class="search_button">
                検索
            </button>
        </form>
        <h3>価格順で表示</h3>
        <div class="select-wrapper">
            <select class="price_select" name="price_search">
                <option value="" class="price_default">価格順で並べ替え</option>
                @foreach ($seasons as $season)
                    <option value="{{ $season->id }}">{{ $season->name }}</option>
                @endforeach
            </select>
            <span class="custom-select-icon"></span>
        </div>
        <p class="lene_bottom"></p>
    </div>
    <div class="products-display">
        @foreach ($products as $product)
        <div class="product_list">
            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
            <h3>{{ $product->name }}</h3>
            <p>¥{{ number_format($product->price) }}</p>
        </div>
        @endforeach
    </div>
</div>       
@endsection