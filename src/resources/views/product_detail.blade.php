@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/product_detail.css') }}">
@endsection

@section('content')
@if ($errors->has('image'))
<div class="alert alert-danger">
    {{ $errors->first('image') }}
</div>
@endif
<div class="product_detail-container">
    <div class="breadcrumb">
        <a href="{{ url('/products') }}" class="breadcrumb-link">
            商品一覧
        </a>＞ {{ $product->name }}
    </div>
    <form action="{{ route('products.update', ['productId' => $product->id]) }}" method="POST" class="update-form">
        @csrf
            @method('PUT')
                <div class="product-options-container">
                    <div class="image-section">
                        <img src="{{ asset('storage/' . $product->image) }}" class="detail-image" alt="商品画像">
                        <div class="custom-file">
                            <input type="file" id="image" name="image" class="hidden">
                            <button type="button" onclick="document.getElementById('image').click();" class="btn-select-file">ファイルを選択</button>
                            <span class="file-name-display">{{ basename($product->image) }}</span>
                        </div>
                        <div class="form__error">
                            @error('image')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="label-control">商品名</label>
                        <input type="text" class="input-control" id="name" name="name" value="{{ $product->name }}">
                        <div class="form__error">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </div>
                        <label for="price" class="label-control">値段</label>
                        <input type="number" class="input-control" id="price" name="price" value="{{ $product->price }}">
                        <div class="form__error">
                            @error('price')
                                {{ $message }}
                            @enderror
                        </div>
                        <span class="season">季節</span>
                        <div class="season-check-container">
                            @foreach ($seasons as $season)
                                <label for="season_{{ $season->name }}" class="season-label">
                                    <input type="checkbox" name="season[]" id="season_{{ $season->name }}" class="season-checkbox" value="{{ $season->id }}" {{ $product->seasons->contains($season->id) ? 'checked' : '' }}> {{ $season->name }}
                                </label>
                            @endforeach
                            <div class="form__error">
                                @error('season')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group-description">
                    <label for="description" class="label-control">商品説明</label>
                    <textarea class="description-control" id="description" name="description">{{ $product->description }}</textarea>
                    <div class="form__error">
                        @error('description')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="update-button-container">
                        <a href="{{ url('products/') }}" class="return-button">戻る</a>
                        <button type="submit" class="update-button">変更を保存</button>
                        <a href="{{ route('products.delete', ['productId' => $product->id]) }}" class="delete-button" onclick="return confirm('本当に削除しますか？');">
                            <img src="{{ asset('images/dustbox.png') }}" alt="Dustbox" class="icon-dustbox">
                        </a>
                    </div>
                </div>
    </form>
</div>
<script>
    document.getElementById('image').addEventListener('change', function() {
        var fileName = this.files[0].name;
        var validExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
        var fileExtension = fileName.split('.').pop().toLowerCase();
        if (!validExtensions.includes(fileExtension)) {
            alert('無効なファイル形式です。');
            this.value = '';  // フォームの値をクリア
        } else {
            document.querySelector('.file-name-display').textContent = fileName;
        }
    });
</script>
@endsection
