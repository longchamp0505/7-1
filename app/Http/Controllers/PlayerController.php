<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;

class PlayerController extends Controller
{
    public function index()
    {
        // 一覧画面から来たことを記録
        session(['from_list' => true]); 
        // 1ページに20件ずつ取得（ページネーション）
        $players = Player::paginate(20);

        return view('players.index', compact('players'));
    }

    public function show($id)
    {
        // 一覧画面から来ていない場合はリダイレクト
        if (!session()->pull('from_list')) {
            return redirect()->route('players.index');
        }
        $player = Player::findOrFail($id);
        return view('players.show', compact('player'));
    }
}
