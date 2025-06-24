@extends('layouts.app')

@section('title', '商品一覧')

@section('content')
<div class="product-container">
    <div class="products-header">
        <h2 class="products-title">商品一覧</h2>
        <a href="{{ route('products.create') }}" class="btn-add">＋ 商品を追加</a>
    </div>

    <div class="product-index-container">
        <div class="sidebar">
            <form method="GET" action="{{ route('products.index') }}">
                <div class="form-group">
                    <input type="text" name="keyword" placeholder="商品名で検索" class="input-text" />
                    <button type="submit" class="search-button">検索</button>
                </div>
            </form>

            @if(request('sort'))
                <div class="sort-tag">
                並び替え:
                @if(request('sort') === 'high') 高い順
                @elseif(request('sort') === 'low') 低い順
                @endif
                <a href="{{ route('products.index', request()->except('sort')) }}" class="remove-tag">×</a>
                </div>
            @endif

        {{-- 並び替えポップアップ --}}
            <form method="GET" action="{{ route('products.index') }}" class="sort-form">
                <h3 class="sort-form-title">価格順で表示</h3>
                <select name="sort" onchange="this.form.submit()">
                    <option value="">価格で並び替え</option>
                    <option value="high" {{ request('sort') === 'high' ? 'selected' : '' }}>高い順に表示</option>
                    <option value="low" {{ request('sort') === 'low' ? 'selected' : '' }}>低い順に表示</option>
                </select>
            </form>
        </div>

        <div class="product-area">
            <div class="product-grid">
            @foreach ($products as $product)
                <div class="product-card">
                    <a href="{{ route('products.show', $product->id) }}">
                        <img src="{{ asset('storage/images/' . $product->image) }}" alt="{{ $product->name }}">
                        <div class="product-info">
                            <div class="product-name">{{ $product->name }}</div>
                            <div class="product-price">¥{{ number_format($product->price) }}</div>
                        </div>
                    </a>
                </div>
            @endforeach
            </div>

            {{-- ページネーションは商品カードの下に表示 --}}
            <div class="pagination">
                {{ $products->appends(request()->query())->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
</div>
@endsection