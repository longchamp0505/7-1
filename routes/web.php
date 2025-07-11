<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| 認証不要のルート（ログイン・登録画面など）
|--------------------------------------------------------------------------
*/

// ログイン画面表示（誰でもアクセス可能）
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// ログイン処理（POSTで送信）
Route::post('/login', [AuthController::class, 'login']);

// ログアウト処理（POSTで送信）
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 新規登録画面表示（誰でもアクセス可能）
Route::get('/setting', [AuthController::class, 'showRegisterForm'])->name('setting');

// 新規登録処理（POSTで送信）
Route::post('/register', [AuthController::class, 'register'])->name('register');


/*
|--------------------------------------------------------------------------
| 認証済みユーザーのみアクセス可能なルート（ミドルウェアで保護）
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // トップページ（選手一覧表示）
    Route::get('/', [PlayerController::class, 'index'])->name('players.index');

    // 選手詳細ページ表示
    Route::get('/players/{id}', [PlayerController::class, 'show'])->name('players.detail');

    // 選手データ削除処理（DELETEメソッド）
    Route::delete('/players/{id}', [PlayerController::class, 'destroy'])->name('players.destroy');

    // 選手編集画面表示
    Route::get('/players/{id}/edit', [PlayerController::class, 'edit'])->name('players.edit');

    // 選手データ更新処理（POSTメソッド）
    Route::post('/players/{id}/update', [PlayerController::class, 'update'])->name('players.update');
});
