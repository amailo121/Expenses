@extends('layouts.app')

@section('title', '予算設定')

@section('content')
<div class="container">
    <h1>予算設定</h1>

    <!-- 成功メッセージの表示 -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- 現在の予算リスト -->
    <h2>現在の予算</h2>
    @if($budgets->isEmpty())
        <p>まだ予算が設定されていません。</p>
    @else
        <ul class="list-group mb-4">
            @foreach($budgets as $budget)
                <li class="list-group-item">
                    <strong>{{ $budget->category }}</strong>: {{ number_format($budget->amount) }} 円
                </li>
            @endforeach
        </ul>
    @endif

    <!-- 予算設定フォーム -->
    <h2>新しい予算を設定</h2>
    <form action="{{ route('budget.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="category" class="form-label">カテゴリ</label>
            <input type="text" class="form-control" id="category" name="category" value="{{ old('category') }}" required>
            @error('category')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">金額</label>
            <input type="number" class="form-control" id="amount" name="amount" value="{{ old('amount') }}" required>
            @error('amount')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">設定する</button>
    </form>
</div>
@endsection