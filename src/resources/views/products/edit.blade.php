@extends('layouts.app')

@section('title', '商品詳細')

@section('content')
<div class="product-detail">
    <div class="product-main">

        {{-- 商品画像 --}}
        <div class="product-image">
            <img src="{{ asset('storage/images/' . $product->image) }}" alt="{{ $product->name }}">
            <input type="file" name="image">
                @if ($errors->has('image'))
                    <p class="error">{{ $errors->first('image') }}</p>
                @endif
        </div>

        {{-- 編集フォーム --}}
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="product-form">
            @csrf
            @method('PUT')

            {{-- 商品名 --}}
            <div class="form-group">
                <label>商品名</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}">
                @if ($errors->has('name'))
                    <p class="error">{{ $errors->first('name') }}</p>
                @endif
            </div>

            {{-- 値段 --}}
            <div class="form-group">
                <label>値段</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}">
                @if ($errors->has('price'))
                    <p class="error">{{ $errors->first('price') }}</p>
                @endif
            </div>

            {{-- 季節 --}}
            <div class="form-group">
                <label>季節</label>
                <div class="season-options">
                    @foreach (['春', '夏', '秋', '冬'] as $season)
                        <label>
                            <input type="checkbox" name="season[]" value="{{ $season }}"
                                {{ is_array(old('season', explode(',', $product->season))) && in_array($season, old('season', explode(',', $product->season))) ? 'checked' : '' }}>
                            {{ $season }}
                        </label>
                    @endforeach
                </div>
                @if ($errors->has('season'))
                    <p class="error">{{ $errors->first('season') }}</p>
                @endif
            </div>

            {{-- 商品説明 --}}
            <div class="form-group">
                <label>商品説明</label>
                <textarea name="description">{{ old('description', $product->description) }}</textarea>
                @if ($errors->has('description'))
                    <p class="error">{{ $errors->first('description') }}</p>
                @endif
            </div>

            {{-- ボタン --}}
            <div class="form-buttons">
                <a href="{{ route('products.index') }}" class="btn-back">戻る</a>
                <button type="submit" class="btn-submit">変更を保存</button>
            </div>
        </form>
    </div>
</div>
@endsection