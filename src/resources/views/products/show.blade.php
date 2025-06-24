@extends('layouts.app')

@section('title', '商品詳細')

@section('content')
<class="product-detail">

    <div class="product-main">
        {{-- 左側：画像 --}}
        <div class="product-image">
            <img src="{{ asset('storage/images/' . $product->image) }}" alt="{{ $product->name }}">
            <input type="file" name="image">
                <p>{{ $product->image }}</p>
                @if ($errors->has('image'))
                    <p class="error">{{ $errors->first('image') }}</p>
                @endif

        </div>

        {{-- 右側：フォーム --}}
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="product-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>商品名</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}">
                @if ($errors->has('name'))
                    <p class="error">{{ $errors->first('name') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label>値段</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}">
                @if ($errors->has('price'))
                    <p class="error">{{ $errors->first('price') }}</p>
                @endif
            </div>


            @php
            $selectedSeasons = explode(',', old('season', $product->season));
            @endphp

            <div class="form-group">
                <label>季節</label>
                <div class="seasons">
                    @foreach (['春', '夏', '秋', '冬'] as $season)
                        <label>
                            <input type="checkbox" name="season[]" value="{{ $season }}"
                                {{ in_array($season, $selectedSeasons) ? 'checked' : '' }}>
                                {{ $season }}
                        </label>
                    @endforeach
                </div>
                @if ($errors->has('season'))
                    <p class="error">{{ $errors->first('season') }}</p>
                @endif
            </div>
        </form>
    </div>

    <div class="form-group">
        <label>商品説明</label>
        <textarea name="description">{{ old('description', $product->description) }}</textarea>
        @if ($errors->has('description'))
            <p class="error">{{ $errors->first('description') }}</p>
        @endif
    </div>

    <div class="buttons">
        <a href="{{ route('products.index') }}" class="back-btn">戻る</a>
        <a href="{{ route('products.edit', $product->id) }}" class="btn-edit">変更を保存</a>
        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="delete-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-btn">🗑️</button>
        </form>
    </div>

</div>
@endsection