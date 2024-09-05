<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\BudgetController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/home', [PageController::class, 'home'])->name('home');
Route::get('/entry', [PageController::class, 'entry'])->name('entry');
Route::get('/list', [PageController::class, 'list'])->name('list');
Route::get('/edit', [PageController::class, 'edit'])->name('edit');
Route::get('/settings', [PageController::class, 'settings'])->name('settings');

Route::get('/budget', [BudgetController::class, 'index'])->name('budget.index');  // 予算設定画面を表示
Route::post('/budget', [BudgetController::class, 'store'])->name('budget.store'); // 予算データの保存

require __DIR__.'/auth.php';
