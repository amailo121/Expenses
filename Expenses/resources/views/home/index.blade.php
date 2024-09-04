<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Bootstrapを使用するためのCDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="mb-4">ホーム</h1>

        <!-- 予算の表示 -->
        <div class="mb-4">
            <h2>予算: {{ $budget->amount ?? '未設定' }}</h2>
        </div>

        <!-- 現在の使用状況（円グラフ） -->
        <div class="mb-4">
            <canvas id="usageChart"></canvas>
        </div>

        <!-- 先月との比較 -->
        <div class="mb-4">
            <h3>先月との比較: <span class="{{ $lastMonthComparison >= 0 ? 'text-success' : 'text-danger' }}">
                {{ $lastMonthComparison >= 0 ? '+' : '' }}{{ $lastMonthComparison }} 円</span></h3>
        </div>

        <!-- 最近の使用状況（取り扱い店舗） -->
        <div class="mb-4">
            <h4>最近の使用状況</h4>
            <ul class="list-group">
                @foreach ($recentTransactions as $transaction)
                    <li class="list-group-item">
                        {{ $transaction->store_name }} - {{ $transaction->amount }} 円
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- メッセージ機能 -->
        <div class="mb-4 alert alert-info">
            {!! $message !!}
        </div>
    </div>

    <script>
        // 現在の使用状況の円グラフ
        var ctx = document.getElementById('usageChart').getContext('2d');
        var usageChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['使用済み', '残り'],
                datasets: [{
                    data: [{{ $currentUsage }}, {{ $budget->amount ?? 0 }} - {{ $currentUsage }}],
                    backgroundColor: ['#FF6384', '#36A2EB']
                }]
            }
        });
    </script>

    <!-- BootstrapのJavaScriptと依存するPopper.jsの読み込み -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>