@extends('layouts.app')
@push('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endpush

@section('content')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">

<div class="product-create-container">

    <h2 class="page-title">商品登録</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- 商品名 --}}
        <label class="form-label">商品名 <span class="required">必須</span></label>
        <input type="text" name="name" placeholder="商品名を入力" value="{{ old('name') }}">
        @error('name')
            <p class="error">{{ $message }}</p>
        @enderror

        {{-- 値段 --}}
        <label class="form-label">値段 <span class="required">必須</span></label>
        <input type="text" name="price" placeholder="値段を入力" value="{{ old('price') }}">
        @error('price')
            <p class="error">{{ $message }}</p>
        @enderror

        {{-- 画像 --}}
        <label class="form-label">商品画像 <span class="required">必須</span></label>
        <input type="file" name="image">
        @error('image')
            <p class="error">{{ $message }}</p>
        @enderror

        {{-- 季節 --}}
        <label class="form-label">季節 <span class="required">必須</span> <span class="sub">複数選択可</span></label>
        <div class="season-group">

            @php
                $seasons = ['春', '夏', '秋', '冬'];
            @endphp

            @foreach ($seasons as $season)
                <label class="season-item">
                    <input type="checkbox" name="season[]" value="{{ $season }}"
                        {{ is_array(old('season')) && in_array($season, old('season')) ? 'checked' : '' }}>
                    {{ $season }}
                </label>
            @endforeach
        </div>

        @error('season')
            <p class="error">{{ $message }}</p>
        @enderror

        {{-- 商品説明 --}}
        <label class="form-label">商品説明 <span class="required">必須</span></label>
        <textarea name="description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
        @error('description')
            <p class="error">{{ $message }}</p>
        @enderror

        <div class="form-buttons">
            <a href="{{ route('products.index') }}" class="btn-back">戻る</a>
            <button type="submit" class="btn-submit">登録</button>
        </div>
    </form>
</div>

@endsection
