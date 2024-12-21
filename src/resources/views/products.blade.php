@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
    <h2 class="products-heading">商品一覧</h2>
    <div class="products-search">
        <input class="search_form" type="text" placeholder="商品名で検索">
        <button type="submit" class="search_button">
            検索
        </button>
        <h3>価格順で表示</h3>
        <div class="select-wrapper">
            <select class="price_select" name="price_search">
            <option value="" class="price_default">価格順で並べ替え</option>
            <option value="spring">春</option>
            <option value="summer">夏</option>
            <option value="autumn">秋</option>
            <option value="winter">冬</option>
            </select>
            <span class="custom-select-icon"></span>
        </div>
        <p class="lene_bottom"></p>
    </div>        
@endsection