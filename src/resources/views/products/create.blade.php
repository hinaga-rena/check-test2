@extends('layouts.app')

@section('title', '商品登録')

@section('content')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">

<div class="product-register">
    <h1>商品登録</h1>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="product-form">
        @csrf

        <div class="form-group">
            <label>商品名 <span class="required">必須</span></label>
            <input type="text" name="name" placeholder="商品名を入力" value="{{ old('name') }}">
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>値段 <span class="required">必須</span></label>
            <input type="number" name="price" placeholder="値段を入力" value="{{ old('price') }}">
            @error('price')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>商品画像 <span class="required">必須</span></label>
            <input type="file" name="image">
            @error('image')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>
                季節 <span class="required">必須</span> <span class="note">複数選択可</span>
            </label>
            <div class="season-options">
                @foreach (['春', '夏', '秋', '冬'] as $season)
                    <label>
                        <input type="checkbox" name="season[]" value="{{ $season }}"
                            {{ is_array(old('season')) && in_array($season, old('season')) ? 'checked' : '' }}>
                        {{ $season }}
                    </label>
                @endforeach
            </div>
            @error('season')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>商品説明 <span class="required">必須</span></label>
            <textarea name="description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
            @error('description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-buttons">
            <a href="{{ route('products.index') }}" class="back-btn">戻る</a>
            <button type="submit" class="submit-btn">登録</button>
        </div>
    </form>
</div>
@endsection