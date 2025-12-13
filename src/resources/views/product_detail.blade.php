@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/product_detail.css') }}">
@endsection

@section('content')
    <div class="container product_detail-container">
        <div class="breadcrumb">
            <a href="{{ url('/products') }}" class="breadcrumb-link link">
                商品一覧
            </a>＞ {{ $product->name }}
        </div>
        <form id="update-form" action="{{ route('products.update', ['productId' => $product->id]) }}" method="POST"
            enctype="multipart/form-data" class="update-form">
            @csrf
            @method('PUT')
            <div class="product-options-container">
                <div class="image-section">
                    <img id="detail-image" src="{{ asset('storage/' . $product->image) }}" class="detail-image"
                        alt="商品画像">
                    <div class="custom-file">
                        <input type="file" id="image" name="image" class="hidden" onchange="previewImage();">
                        <button type="button" onclick="document.getElementById('image').click();"
                            class="btn-select-file button">ファイルを選択</button>
                        <span id="file-name-display" class="file-name-display">{{ basename($product->image) }}</span>
                    </div>
                    <div class="form__error">
                        @error('image')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="name-section label-control">商品名</label>
                    <input type="text" class="name-input input-control" id="name" name="name"
                        value="{{ $product->name }}">
                    <div class="form__error">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </div>
                    <label for="price" class="label-control">値段</label>
                    <input type="text" class="input-control" id="price" name="price" value="{{ $product->price }}">
                    <div class="form__error">
                        @error('price')
                            {{ $message }}
                        @enderror
                    </div>
                    <span class="season">季節</span>
                    <div class="season-check-container">
                        @foreach ($seasons as $season)
                            <label for="season_{{ $season->name }}" class="season-label">
                                <input type="checkbox" name="season[]" id="season_{{ $season->name }}"
                                    class="season-checkbox" value="{{ $season->id }}"
                                    {{ $product->seasons->contains($season->id) ? 'checked' : '' }}><span
                                    class="season-label-text">{{ $season->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    <div class="form__error">
                        @error('season')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group form-group-description">
                <label for="description" class="label-control">商品説明</label>
                <textarea class="input-control description-control" id="description" name="description">{{ $product->description }}</textarea>
                <div class="form__error">
                    @error('description')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </form>
        <div class="button-container">
            <div class="update-button-container">
                <a href="{{ url('products/') }}" class="return-button link">戻る</a>
                <button type="submit" form="update-form" class="update-button button">変更を保存</button>
            </div>
            <form action="{{ route('products.delete', ['productId' => $product->id]) }}" method="POST"
                onsubmit="return confirm('本当に削除しますか？');" class="delete-form">
                @csrf
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="delete-button button">
                    <img src="{{ asset('images/dust_box.png') }}" alt="削除">
                </button>
            </form>
        </div>
    </div>
    <script>
        function previewImage() {
            var file = document.getElementById('image').files[0];
            var reader = new FileReader();

            reader.onloadend = function() {
                document.getElementById('detail-image').src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
                document.getElementById('file-name-display').textContent = file.name;
            } else {
                document.getElementById('detail-image').src = "{{ asset('storage/' . $product->image) }}";
                document.getElementById('file-name-display').textContent = "{{ basename($product->image) }}";
            }
        }
    </script>
@endsection
