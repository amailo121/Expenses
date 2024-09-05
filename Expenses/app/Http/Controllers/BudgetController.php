<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
{
    // 予算設定画面を表示
    public function index()
    {
        $user = Auth::user(); // ログインユーザー
        $budgets = Budget::where('user_id', $user->id)->get(); // ログインユーザーに関連する予算を取得

        return view('budget.index', compact('budgets'));
    }

    // 予算データを保存
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        // 予算データを作成または更新
        Budget::updateOrCreate(
            ['user_id' => Auth::id(), 'category' => $request->category],
            ['amount' => $request->amount]
        );

        return redirect()->route('budget.index')->with('success', '予算が設定されました。');
    }
}