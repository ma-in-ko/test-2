<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mogitate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    @stack('css')

    <style>
        /* ---------- ヘッダー（mogitate） ---------- */
        .site-header {
            width: 100%;
            padding: 15px 40px;
            background: #fff;
        }

        .header-title {
            font-family: 'Playfair Display', serif;
            font-size: 26px;
            font-weight: bold;
            color: #f1c40f;
            padding-left: 100px;
        }

        /* ---------- ページタイトル + 追加ボタン ---------- */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .add-btn {
            background: #f1c40f;
            color: #000;
            padding: 10px 18px;
            border-radius: 6px;
            font-weight: bold;
            text-decoration: none;
        }

        .add-btn:hover {
            opacity: 0.8;
        }

        /* ---------- カスタムページネーション（＜1 2 3＞） ---------- */
        .pagination {
            margin-top: 35px;
            text-align: center;
            font-size: 18px;
        }

        .pagination a,
        .pagination span {
            margin: 0 8px;
            text-decoration: none;
            color: #333;
        }

        .pagination .current {
            font-weight: bold;
        }

        .pagination .disabled {
            color: #ccc;
        }
    </style>

</head>
<body>

    {{-- ヘッダー --}}
    <header class="site-header">
        <div class="header-title">mogitate</div>
    </header>

    <main>
        @yield('content')
    </main>

</body>
</html>

