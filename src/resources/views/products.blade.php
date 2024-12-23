@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')

<div class="product-container">
    <h2 class="products-heading">
        商品一覧
    </h2>
    <button class="add-product-button">
        +　商品を追加
    </button>
</div>
<div class="product">
    <div class="products-search">
        <form action="{{ route('products.search')}}" method="GET">
            <input class="search_form" type="text" name="query" placeholder="商品名で検索">
            <button type="submit" class="search_button">
                検索
            </button>
        </form>
        <h3 class="price-order-label">価格順で表示</h3>
        <form action="{{ route('products.index') }}" method="GET">
            <div class="select-wrapper">
                <select class="price_select" name="price_search" onchange="this.form.submit()">
                    <option value="" class="price_text">価格順で並べ替え</option>
                    <option value="high_to_low" {{ request('price_search') == 'high_to_low' ? 'selected' : '' }}>価格が高い順に表示</option>
                    <option value="low_to_high" {{ request('price_search') == 'low_to_high' ? 'selected' : '' }}>価格が低い順に表示</option>
                </select>
                <span class="custom-select-icon"></span>
            </div>
            <p class="lene_bottom"></p>
            @if(request('price_search'))
                <div class="sort-tag">
                    @if(request('price_search') == 'high_to_low')
                        高い順に表示
                    @elseif(request('price_search') == 'low_to_high')
                        低い順に表示
                    @else
                        価格順で並べ替え
                    @endif
                    <a href="{{ route('products.index') }}" class="reset-button">☓</a>
                </div>
            @endif
        </form>
    </div>
    <div class="products-display">
        @foreach ($products as $product)
            <div class="product_list">
                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="list-imge">
                <div class="list-text">
                    <span class="list-name">{{ $product->name }}</span>
                    <span class="list-price">¥{{ number_format($product->price) }}</span>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div class="pagination-container">
    {{ $products->links() }} 
</div>
@endsection
