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
            <a href="{{ route('products.register') }}" class="add-product-button link">
                + 商品を追加
            </a>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="product">
            <div class="products-search">
                <form class="products-search-form" action="{{ route('products.search') }}" method="GET">
                    <div class="name-search-container">
                        <input class="name-search input" type="text" name="query" placeholder="商品名で検索" value="{{ request('query') }}">
                        <button type="submit" class="search_button button">
                            検索
                        </button>
                    </div>
                    <div class="price-order-container">
                        <h3 class="price-order-label">価格順で表示</h3>
                        <div class="select-wrapper">
                            <select class="price_select select" name="price_search" id="price_search">
                                <option value="high_to_low" {{ request('price_search') == 'high_to_low' ? 'selected' : '' }}>
                                    高い順に表示</option>
                                <option value="low_to_high" {{ request('price_search') == 'low_to_high' ? 'selected' : '' }}>
                                    安い順に表示</option>
                            </select>
                            <div class="custom-dropdown select">
                                <div class="custom-dropdown-trigger">
                                    <span class="custom-dropdown-text">
                                        @if (request('price_search') == 'high_to_low')
                                            高い順に表示
                                        @elseif(request('price_search') == 'low_to_high')
                                            安い順に表示
                                        @else
                                            価格順で並べ替え
                                        @endif
                                    </span>
                                    <span class="custom-select-icon"></span>
                                </div>
                                <div class="custom-dropdown-menu">
                                    <div class="custom-dropdown-option {{ request('price_search') == 'high_to_low' ? 'selected' : '' }}"
                                        data-value="high_to_low">高い順に表示</div>
                                    <div class="custom-dropdown-option {{ request('price_search') == 'low_to_high' ? 'selected' : '' }}"
                                        data-value="low_to_high">安い順に表示</div>
                                </div>
                            </div>
                        </div>
                        @if (request('price_search'))
                            <div class="tag sort-tag">
                                @if (request('price_search') == 'high_to_low')
                                    高い順に表示
                                @elseif(request('price_search') == 'low_to_high')
                                    低い順に表示
                                @else
                                    価格順で並べ替え
                                @endif
                                <a href="{{ route('products.index') }}" class="reset-button link"><span class="cross_image"></span></a>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
            <div class="products-display">
                @foreach ($products as $product)
                    <div class="product_list">
                        <a href="{{ route('products.show', ['productId' => $product->id]) }}"
                            class="product-detail-link link">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="list-image">
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdown = document.querySelector('.custom-dropdown');
            const trigger = document.querySelector('.custom-dropdown-trigger');
            const menu = document.querySelector('.custom-dropdown-menu');
            const options = document.querySelectorAll('.custom-dropdown-option');
            const select = document.getElementById('price_search');
            const form = document.querySelector('.products-search-form');

            if (trigger && menu && options.length > 0) {
                // ドロップダウンの開閉
                trigger.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const isOpening = !dropdown.classList.contains('active');
                    dropdown.classList.toggle('active');

                    // 開いた時に選択状態をリセット
                    if (isOpening) {
                        options.forEach(opt => opt.classList.remove('selected'));
                    }
                });

                // オプション選択
                options.forEach(option => {
                    option.addEventListener('click', function() {
                        const value = this.getAttribute('data-value');
                        const text = this.textContent.trim();

                        // select要素の値を更新
                        select.value = value;

                        // 選択状態を更新（視覚的に強調）
                        options.forEach(opt => opt.classList.remove('selected'));
                        this.classList.add('selected');

                        // 少し待ってから表示テキストを更新してフォームを送信
                        setTimeout(function() {
                            // 表示テキストを更新
                            document.querySelector('.custom-dropdown-text').textContent =
                                text;

                            // ドロップダウンを閉じる
                            dropdown.classList.remove('active');

                            // フォームを送信
                            form.submit();
                        }, 300);
                    });
                });

                // 外側をクリックしたら閉じる
                document.addEventListener('click', function(e) {
                    if (!dropdown.contains(e.target)) {
                        dropdown.classList.remove('active');
                    }
                });
            }
        });
    </script>
@endsection
