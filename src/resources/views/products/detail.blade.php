@extends('layouts.app')
@push('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endpush

@section('content')

<div class="edit-container">

    {{-- ページタイトル --}}
    <div class="page-title">
        <a href="{{ route('products.index') }}">商品一覧</a> ＞ {{ $product->name }}
    </div>

    <div class="edit-wrapper">

        {{-- 左：画像エリア --}}
        <div class="image-area">

            {{-- 商品画像（重要：storage/images に変更） --}}
            <img src="{{ asset('storage/images/' . $product->image) }}" alt="商品画像" class="product-image">

            {{-- 画像アップロード --}}
            <label class="file-label">
                画像を変更
                <input type="file" name="image" form="updateForm" class="file-input">
            </label>
            <span class="file-name">{{ $product->image }}</span>

            {{-- 商品説明（左カラムに配置） --}}
            <label class="form-label mt-30">商品説明</label>
            <textarea name="description" form="updateForm" class="desc">
                {{ old('description', $product->description) }}
            </textarea>

        </div>

        {{-- 右：フォーム --}}
        <div class="form-area">

            <form id="updateForm" method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- 商品名 --}}
                <label class="form-label">商品名</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-input">

                {{-- 値段 --}}
                <label class="form-label">値段</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" class="form-input">

                {{-- 季節 --}}
                <label class="form-label">季節</label>
                <div class="season-box">
                    @foreach($seasons as $season)
                        <label class="season-item">
                            <input type="checkbox" name="season" value="{{ $season->id }}" {{ in_array($season->id, $product->seasons->pluck('id')->toArray()) ? 'checked' : '' }}>
                            {{ $season->name }}
                        </label>
                    @endforeach
                </div>

                {{-- ボタンエリア --}}
                <div class="btn-area">
                    <a href="{{ route('products.index') }}" class="btn-back">戻る</a>
                    <button type="submit" class="btn-update">変更を保存</button>
                </div>

            </form>

            {{-- 削除フォーム --}}
            <form method="POST"action="{{ route('products.destroy', $product->id) }}"onsubmit="return confirm('削除しますか？');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">🗑</button>
            </form>

        </div>

    </div>
</div>

@endsection
