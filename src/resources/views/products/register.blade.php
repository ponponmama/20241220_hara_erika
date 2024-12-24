@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content-register')
<div class="container">
    <h1>商品登録</h1>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="register-form">
        @csrf
        <div class="form-group">
            <label for="name">商品名</label>
            <span class="required-label">必須</span>
        </div>
        <input type="text" class="form-control" id="name" name="name" placeholder="商品名を入力">
        <div class="form__error">
            @error('name')
                {{ $message }}
            @enderror
        </div>
        <div class="form-group">
            <label for="price">値段</label>
            <span class="required-label">必須</span>
        </div>
        <input type="number" class="form-control" id="price" name="price" placeholder="値段を入力">
        <div class="form__error">
            @error('price')
                {{ $message }}
            @enderror
        </div>
        <div class="form-group">
            <label for="image">商品画像</label>
            <span class="required-label">必須</span>
        </div>
        <input type="file" class="form-control-file" id="image" name="image">
        <div class="form__error">
            @error('image')
                {{ $message }}
            @enderror
        </div>
        <div class="form-group">
            <label for="season">季節</label>
            <span class="required-label">必須</span>
            <p class="multiple-select">複数選択可</p>
        </div>
        <div class="radio_button">
            <label for="spring">
                <input type="checkbox" name="season[]" value="spring" id="spring" class="season-spring"> 春
            </label>
            <label for="summer">
                <input type="checkbox" name="season[]" value="summer" id="summer" class="season-select"> 夏
            </label>
            <label for="autumn">
                <input type="checkbox" name="season[]" value="autumn" id="autumn" class="season-select"> 秋
            </label>
            <label for="winter">
                <input type="checkbox" name="season[]" value="winter" id="winter" class="season-sinter"> 冬
            </label>
        </div>
        <div class="form__error">
            @error('season')
                {{ $message }}
            @enderror
        </div>
        <div class="form-group">
            <label for="description">商品説明</label>
            <span class="required-label">必須</span>
        </div>
        <textarea class="description-control" id="description" name="description"  placeholder="商品の説明を入力"></textarea>
        <div class="form__error">
            @error('description')
                {{ $message }}
            @enderror
        </div>
        <div class="form-buttons">
            <a href="{{ url('products/') }}" class="return-button">戻る</a>
            <button type="submit" class="register-button">登録</button>
        </div>
    </form>
</div>
@endsection