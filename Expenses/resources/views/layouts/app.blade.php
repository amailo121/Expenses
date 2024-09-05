<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '家計簿アプリ')</title>
    <!-- Bootstrapの読み込み -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- ナビゲーションバー -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">家計簿アプリ</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">ホーム</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('entry') }}">入力</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('list') }}">一覧</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('edit') }}">編集</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('settings') }}">設定</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- コンテンツ部分 -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- フッター -->
    <footer class="bg-light text-center text-lg-start mt-5 py-3">
        <div class="text-center p-3">
            © 2024 家計簿アプリ - All Rights Reserved
        </div>
    </footer>

    <!-- Bootstrap JSと依存関係の読み込み -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
