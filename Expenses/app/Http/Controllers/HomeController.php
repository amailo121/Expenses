<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;
use App\Models\Transaction;

class HomeController extends Controller
{
    public function index()
    {
        // 予算情報を取得
        $budget = Budget::first();

        // 現在の使用状況と先月との比較を取得
        $currentUsage = $this->getCurrentUsage();
        $lastMonthComparison = $this->compareWithLastMonth();

        // 最近の使用状況（取扱店舗）
        $recentTransactions = Transaction::latest()->take(5)->get();

        // メッセージ機能
        $message = $this->generateMessage($budget, $currentUsage);

        return view('home.index', compact('budget', 'currentUsage', 'lastMonthComparison', 'recentTransactions', 'message'));
    }

    private function getCurrentUsage()
    {
        // 使用状況を計算（仮）
        return 50000; // 仮のデータ
    }

    private function compareWithLastMonth()
    {
        // 先月との比較を計算（仮）
        return -2000; // 仮のデータ
    }

    private function generateMessage($budget, $currentUsage)
    {
        if (is_null($budget)) {
            return '予算設定をしますか？ <a href="#">予算設定</a>';
        } elseif ($currentUsage > $budget->amount) {
            return '予算オーバーしています。';
        } else {
            return '予算通りです。';
        }
    }
}