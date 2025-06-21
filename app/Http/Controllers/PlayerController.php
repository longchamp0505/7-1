<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;

class PlayerController extends Controller
{
    public function index()
    {
        // 1ページに20件ずつ取得（ページネーション）
        $players = Player::paginate(20);

        return view('players.index', compact('players'));
    }

    public function show($id)
    {
        $player = Player::findOrFail($id);
        return view('players.show', compact('player'));
    }
}
