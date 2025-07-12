<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Player;
use App\Models\Country;

class PlayerController extends Controller
{
    public function index()
    {
        // 一覧画面から来たことを記録
        session(['from_list' => true]);

        // ログインユーザーを取得
        $user = Auth::user();

        // players テーブル + country を結合
        $query = Player::with('country')->where('del_flg', 0);

        if ($user->role == 1) {
            // 一般ユーザーの場合は、自分の所属国の選手のみ表示
            $query->where('country_id', $user->country_id);
        }
        // 管理者の場合（role==0）は制限なし

        $players = $query->paginate(20);

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
        if (Auth::user()->role != 0) {
        abort(403, 'Unauthorized action.');
        }
        
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

        return redirect()->route('players.index');
    }
}
