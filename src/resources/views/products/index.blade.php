@extends('layouts.app')
@push('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endpush

@section('content')

<div class="container">

    {{-- ================================
        ページタイトル & 商品追加ボタン
    ================================= --}}
    <div class="page-header">
        <h2>商品一覧</h2>

        {{-- 商品追加ボタン（管理者用） --}}
        <a href="{{ route('products.register') }}" class="add-btn">＋ 商品を追加</a>
    </div>

    {{-- ================================
        コンテンツ（2カラム：左/右）
    ================================= --}}
    <div class="content-wrapper">

        {{-- ----------------------------------
            左：検索フォーム + 並び替え
        ----------------------------------- --}}
        <div class="sidebar">

            {{-- 検索フォーム --}}
            <form action="{{ route('products.index') }}" method="GET" class="search-form">
                <input
                    type="text"
                    name="keyword"
                    value="{{ $keyword ?? '' }}"
                    placeholder="商品名で検索"
                />
                <button type="submit" class="search-btn">検索</button>
            </form>

            {{-- 並び替え --}}
            <div class="sort-box">
                <p class="sort-title">価格順で表示</p>

                <form action="{{ route('products.index') }}" method="GET">
                    {{-- セレクトボックス --}}
                    <select name="sort" class="sort-select" onchange="this.form.submit()">
                        <option value="" {{ $sort === null ? 'selected' : '' }}>価格で並び替え</option>
                        <option value="high" {{ $sort === 'high' ? 'selected' : '' }}>高い順に表示</option>
                        <option value="low" {{ $sort === 'low' ? 'selected' : '' }}>低い順に表示</option>
                    </select>

                    {{-- 検索キーワードを保持 --}}
                    <input type="hidden" name="keyword" value="{{ $keyword ?? '' }}">
                </form>

                @if(request('sort'))
                <div class="sort-modal">
                    <span class="sort-text">
                        {{ request('sort') === 'high' ? '高い順に表示' : '低い順に表示' }}
                    </span>
                    <a href="{{ route('products.index') }}" class="sort-close">×</a>
                </div>
                @endif

            </div>

        </div> {{-- /sidebar --}}

        {{-- ----------------------------------
            右：商品カード一覧
        ----------------------------------- --}}
        <div class="product-list">
            @foreach($products as $product)
                <a href="{{ route('products.detail', ['productId' => $product->id]) }}" class="product-card">
                    <div class="product-image">
                        <img src="{{ asset('storage/images/' . $product->image) }}" alt="{{ $product->name }}">
                    </div>

                    <div class="product-info">
                        <p class="product-name">{{ $product->name }}</p>
                        <p class="product-price">¥{{ number_format($product->price) }}</p>
                    </div>
                </a>
            @endforeach
        </div>{{-- /product-list --}}

    </div>{{-- /content-wrapper --}}

    {{-- ================================
        ページネーション
    ================================= --}}
    <div class="pagination-wrapper">
        {{ $products->links() }}
    </div>

</div>{{-- /container --}}

{{-- ================================
    並び替えリセット処理
================================= --}}
<script>
    function resetSort() {
        const query = new URLSearchParams(window.location.search);

        // sort パラメータ削除
        query.delete('sort');

        // sort 以外の条件を保持したままリロード
        const newQuery = query.toString();
        const url = "{{ route('products.index') }}" + (newQuery ? "?" + newQuery : "");

        window.location.href = url;
    }
</script>

@endsection
