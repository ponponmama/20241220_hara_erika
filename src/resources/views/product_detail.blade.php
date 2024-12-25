@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/product_detail.css') }}">
@endsection

@section('content')
<div class="breadcrumb">
    <a href="{{ url('/products') }}" class="breadcrumb-link">
        商品一覧
    </a>＞ {{ $product->name }}
</div>
<div class="product_detail-container">
    <img src="{{ asset('storage/' . $product->image) }}" class="detail-image">
    <form action="{{ route('products.update', ['productId' => $product->id]) }}" method="POST" class="update-form">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="image">商品画像</label>
            <div class="custom-file">
                <input type="file" id="image" name="image" class="hidden">
                <button type="button" onclick="document.getElementById('image').click();"
                    class="btn-select-file">ファイルを選択</button>
                <span class="file-name-display">{{ basename($product->image) }}</span>
            </div>
            <div class="form__error">
                @error('image')
                    {{ $message }}
                @enderror
            </div>
            <label for="name">商品名</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
            <div class="form__error">
                @error('name')
                    {{ $message }}
                @enderror
            </div>
            <label for="price">値段</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}">
            <div class="form__error">
                @error('price')
                    {{ $message }}
                @enderror
            </div>
            <label for="season">季節</label>
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
        </div>
        <div class="form-group">
            <label for="description">商品説明</label>
        </div>
        <textarea class="description-control" id="description" name="description" value="{{ $product->description }}"></textarea>
        <div class="form__error">
            @error('description')
                {{ $message }}
            @enderror
        </div>
        <a href="{{ url('products/') }}" class="return-button">戻る</a>
        <button type="submit" class="update-button">変更を保存</button>
    </form>
</div>
<script>
    document.getElementById('image').addEventListener('change', function() {
        var fileName = this.files[0].name;
        document.querySelector('.file-name-display').textContent = fileName;
    });
</script>
@endsection
