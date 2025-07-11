<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    // ログイン画面
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // ログイン処理
    public function login(Request $request)
    {
        // バリデーション
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'この項目は必須入力です。',
            'email.email' => 'emailの形式で入力してください。',
            'password.required' => 'この項目は必須入力です。',
        ]);

        // 入力値を取得
        $email = $request->input('email');
        $password = $request->input('password');

        // usersテーブルに同じメールアドレスがあるか確認
        $user = \App\Models\User::where('email', $email)->first();

        if (!$user) {
            // メールアドレスが未登録
            return back()->withErrors([
                'email' => 'このメールアドレスは登録されていません。',
            ]);
        }

        // パスワードが一致するか確認
        if (!\Illuminate\Support\Facades\Hash::check($password, $user->password)) {
            // パスワード不一致
            return back()->withErrors([
                'password' => '入力されたパスワードは登録されている内容と違います',
            ]);
        }

        // ログイン成功
        \Illuminate\Support\Facades\Auth::login($user);

        return redirect()->route('players.index'); 
    }

    // ログアウト
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    // 新規登録画面
    public function showRegisterForm()
    {
        $countries = DB::table('countries')->get();  // countriesテーブルから全件取得
        return view('auth.register', compact('countries'));
    }

    // 新規登録処理
    public function register(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'country_id' => 'required|integer',
        ], [
            'email.required' => 'この項目は必須入力です。',
            'email.email' => 'emailの形式で入力してください。',
            'email.unique' => '入力されたメールアドレスはすでに登録されています。',
            'password.required' => 'この項目は必須入力です。',
            'password.min' => 'パスワードは8文字以上で入力してください。',
            'password.confirmed' => 'パスワードが確認用と一致していません。',
            'country_id.required' => 'この項目は必須入力です。',
            'country_id.integer' => 'この項目は必須入力です。', // 数値でない場合も必須入力のメッセージを表示
        ]);

        $user = new User();
        $user->email = $validated['email'];
        $user->password = bcrypt($validated['password']);
        $user->country_id = $validated['country_id'];
        $user->role = 1; // 一般ユーザー
        $user->save();

        Auth::login($user);
        return redirect('/'); // 登録後に遷移
    }
}
