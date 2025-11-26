@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
<div class="container product-container">
    <div class="product-title-bar">
        <h2 class="title-name">
            商品一覧
        </h2>
        <div class="button-container">
            <a href="{{ route('products.register') }}" class="common-link add-product-button">
                + 商品を追加
            </a>
        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="product">
        <div class="products-search">
            <form action="{{ route('products.search')}}" method="GET">
                <input class="name-search" type="text" name="query" placeholder="商品名で検索" value="{{ request('query') }}">
                <button type="submit" class="common-button search_button">
                    検索
                </button>
                <h3 class="price-order-label">価格順で表示</h3>
                <div class="select-wrapper">
                    <select class="common-select price_select" name="price_search" onchange="this.form.submit()">
                        <option value="" class="price_text">価格順で並べ替え</option>
                        <option value="high_to_low" {{ request('price_search') == 'high_to_low' ? 'selected' : '' }}>価格が高い順に表示</option>
                        <option value="low_to_high" {{ request('price_search') == 'low_to_high' ? 'selected' : '' }}>価格が低い順に表示</option>
                    </select>
                    <span class="custom-select-icon"></span>
                </div>
                <p class="line_bottom"></p>
                @if(request('price_search'))
                    <div class="tag sort-tag">
                        @if(request('price_search') == 'high_to_low')
                            高い順に表示
                        @elseif(request('price_search') == 'low_to_high')
                            低い順に表示
                        @else
                            価格順で並べ替え
                        @endif
                        <a href="{{ route('products.index') }}" class="common-link reset-button"><span class="cross_image"></span></a>
                    </div>
                @endif
            </form>
        </div>
        <div class="products-display">
            @foreach ($products as $product)
                <div class="product_list">
                    <a href="{{ route('products.show', ['productId' => $product->id]) }}" class="common-link product-detail-link">
                        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="list-image">
                    </a>
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
</div>
@endsection
