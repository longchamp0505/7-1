<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Country;

class PlayerController extends Controller
{
    public function index()
    {
        // 一覧画面から来たことを記録
        session(['from_list' => true]); 

        // del_flg が 0 のみ取得し、国情報も結合
        $players = Player::with('country')->where('del_flg', 0)->paginate(20);

        return view('players.index', compact('players'));
    }

    public function show($id)
    {
        // 一覧画面から来ていない場合はリダイレクト
        if (!session()->pull('from_list')) {
            return redirect()->route('players.index');
        }
        $player = Player::with('goals.pairing.enemyCountry')->findOrFail($id);
        $totalGoals = $player->goals->count();

        return view('players.detail', compact('player', 'totalGoals'));
    }
    
    public function destroy($id)
    {
    $player = Player::findOrFail($id);
    $player->del_flg = 1;
    $player->save();

    return redirect()->route('players.index');
    }

    public function edit($id)
    {
    $player = Player::findOrFail($id);

    $countries = Country::all(); // 国プルダウン用
    $positions = Player::select('position')->distinct()->pluck('position'); // ポジションプルダウン用

    return view('players.edit', compact('player', 'countries', 'positions'));
    }

    public function update(Request $request, $id)
    {
    $request->validate([
        'uniform_num' => ['required', 'integer'],
        'position' => ['required', 'string'],
        'name' => ['required', 'string', 'max:50'],
        'country_id' => ['required', 'exists:countries,id'],
        'club' => ['required', 'string'],
        'birth' => ['required', 'date_format:Y-m-d'],
        'height' => ['required', 'integer'],
        'weight' => ['required', 'integer'],
    ], [
        'required' => 'この項目は必須入力です。',
        'integer' => 'この項目は半角数字で入力してください。',
        'date_format' => 'この項目は「YYYY-MM-DD」で入力してください。',
    ]);

    $player = Player::findOrFail($id);
    $player->update($request->all());

    return redirect()->route('players.show', $id);
    }

}
