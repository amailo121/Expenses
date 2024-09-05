@extends('layouts.app')

@section('title', 'ホーム')

@section('content')
    <h1>ホームページ</h1>

    <!-- 予算の表示 -->
    <div class="mb-4">
        <h2>予算:</h2>
        @foreach($budgets as $budget)
            <p>{{ $budget->category->name }}: {{ $budget->amount ?? '未設定' }} 円</p>
        @endforeach
    </div>

    <!-- 現在の使用状況（円グラフで表示予定） -->
    <div class="mb-4">
        <canvas id="usageChart"></canvas>
    </div>

    <!-- 先月との比較 -->
    <div class="mb-4">
        <h3>先月との比較: <span class="{{ $lastMonthComparison >= 0 ? 'text-success' : 'text-danger' }}">
            {{ $lastMonthComparison >= 0 ? '+' : '' }}{{ $lastMonthComparison }} 円</span></h3>
    </div>

    <!-- 最近の使用状況 -->
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

    <!-- 円グラフのスクリプト -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('usageChart').getContext('2d');
        var usageChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['使用済み', '残り'],
                datasets: [{
                    data: [{{ $currentUsage }}, {{ $budgets->sum('amount') ?? 0 }} - {{ $currentUsage }}],
                    backgroundColor: ['#FF6384', '#36A2EB']
                }]
            }
        });
    </script>
@endsection