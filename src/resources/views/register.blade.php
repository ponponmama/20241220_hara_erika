@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content-register')
<div class="register-container">
    <h1 class="product-registration-title">商品登録</h1>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="register-form">
        @csrf
        <div class="form-group">
            <label for="name" class="form-label">
                商品名
                <span class="required-label">必須</span>
            </label>
        </div>
        <input type="text" class="form-control" id="name" name="name" placeholder="商品名を入力">
        <div class="form__error">
            @error('name')
                {{ $message }}
            @enderror
        </div>
        <div class="form-group">
            <label for="price" class="form-label">
                値段
                <span class="required-label">必須</span>
            </label>
        </div>
        <input type="number" class="form-control" id="price" name="price" placeholder="値段を入力">
        <div class="form__error">
            @error('price')
                {{ $message }}
            @enderror
        </div>
        <div class="form-group">
            <label for="image" class="form-label">
                商品画像
                <span class="required-label">必須</span>
            </label>
        </div>
        <div class="custom-file">
            <input type="file" id="image" name="image" class="hidden" onchange="previewImage();">
            <img id="image-preview" src="#" alt="" class="image-preview">
            <button type="button" onclick="document.getElementById('image').click();" class="btn-select-file">ファイルを選択</button>
            <span id="file-name-display"></span>
        </div>
        <div class="form__error">
            @error('image')
                {{ $message }}
            @enderror
        </div>
        <div class="form-group">
            <span class="season">季節</span>
            <span class="required-label">必須</span>
            <span class="multiple-select">複数選択可</span>
        </div>
        <div class="season-check-container">
            <label for="spring" class="season-label">
                <input type="checkbox" name="season[]" value="春" id="spring" class="season-spring"> 春
            </label>
            <label for="summer" class="season-label">
                <input type="checkbox" name="season[]" value="夏" id="summer" class="season-select"> 夏
            </label>
            <label for="autumn" class="season-label">
                <input type="checkbox" name="season[]" value="秋" id="autumn" class="season-select"> 秋
            </label>
            <label for="winter" class="season-label">
                <input type="checkbox" name="season[]" value="冬" id="winter" class="season-sinter"> 冬
            </label>
        </div>
        <div class="form__error">
            @error('season')
                {{ $message }}
            @enderror
        </div>
        <div class="form-group">
            <label for="description" class="description-label">
                商品説明
                <span class="required-label">必須</span>
            </label>
        </div>
        <textarea class="description-control" id="description" name="description" placeholder="商品の説明を入力"
            autocomplete="off"></textarea>
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
<script>
    function previewImage() {
        var file = document.getElementById('image').files[0];
        var reader = new FileReader();

        reader.onloadend = function() {
            var preview = document.getElementById('image-preview');
            preview.src = reader.result;
            preview.style.display = 'block';
        }

        if (file) {
            reader.readAsDataURL(file);
            document.getElementById('file-name-display').textContent = file.name;
        } else {
            var preview = document.getElementById('image-preview');
            preview.src = "";
            preview.style.display = 'none';
            document.getElementById('file-name-display').textContent = "";
        }
    }
</script>
@endsection
