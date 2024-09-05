<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Budget;

class HomeController extends Controller
{
    public function index()
    {
        // ログインユーザーを取得
        $user = Auth::user();

        // ユーザーに紐付いた予算を取得
        $budgets = $user->budgets;

        // 現在の使用状況と先月との比較を取得
        $currentUsage = $this->getCurrentUsage($budgets);
        $lastMonthComparison = $this->compareWithLastMonth($budgets);

        // 最近の使用状況（取り扱い店舗）
        $recentTransactions = $this->getRecentTransactions($budgets);

        // メッセージ機能
        $message = $this->generateMessage($budgets, $currentUsage);

        return view('home', compact('budgets', 'currentUsage', 'lastMonthComparison', 'recentTransactions', 'message'));
    }

    private function getCurrentUsage($budgets)
    {
        // 使用状況を計算（仮のロジック）
        return $budgets->sum('amount');
    }

    private function compareWithLastMonth($budgets)
    {
        // 先月との比較を計算（仮のロジック）
        return -2000;  // 仮のデータ
    }

    private function getRecentTransactions($budgets)
    {
        // 最近の取引を取得（仮のロジック）
        return [];
    }

    private function generateMessage($budgets, $currentUsage)
    {
        if ($budgets->isEmpty()) {
            return '予算設定をしますか？ <a href="#">予算設定</a>';
        } elseif ($currentUsage > $budgets->sum('amount')) {
            return '予算オーバーしています。';
        } else {
            return '予算通りです。';
        }
    }
}