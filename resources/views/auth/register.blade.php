<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>新規登録</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
    <div class="form-container">
        <h1>新規登録</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="registration_login_id_input">メールアドレス:</label>
                <input type="email" id="registration_login_id_input" name="email" placeholder="メールアドレス" required>
                @error('email')
                    <div id="registration_login_validation" class="validation">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="registration_password_input">パスワード:</label>
                <input type="password" id="registration_password_input" name="password" placeholder="パスワード" required>
                @error('password')
                    <div id="registration_password_validation" class="validation">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="registration_re_password_input">パスワード確認:</label>
                <input type="password" id="registration_re_password_input" name="password_confirmation" placeholder="パスワード確認" required>
                @error('password_confirmation')
                    <div id="registration_re_password_validation" class="validation">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>ユーザー種別:</label>
                <div class="radio-group" id="registration_user_type_radio">
                    <label><input type="radio" name="role" value="1" checked> 一般ユーザー</label>
                    <label><input type="radio" name="role" value="0"> 管理者</label>
                </div>
            </div>

            <div class="form-group">
                <label for="registration_country_select">所属国:</label>
                <select id="registration_country_select" name="country_id" required>
                    <option value="">選択してください</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
                @error('country_id')
                    <div id="registration_country_validation" class="validation">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" id="registration_button" class="register-btn">登録</button>
        </form>
        <a href="{{ route('login') }}" id="registration_back_button" class="back-btn">ログイン画面に戻る</a>
    </div>
    <script src="{{ asset('js/register.js') }}"></script>
</body>
</html>
