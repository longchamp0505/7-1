<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <form method="POST" action="{{ route('login') }}">
        <h1>ログイン</h1>
        @csrf
        <label>ログインID:</label>

        @if ($errors->has('email'))
            <div id="login_validation" style="color:red;">
                {{ $errors->first('email') }}
            </div>
        @endif

        <input type="text" id="login_id_input" name="email" placeholder="メールアドレス">


        <label>パスワード:</label>

        @if ($errors->has('password'))
            <div id="password_validation" style="color:red;">
                {{ $errors->first('password') }}
            </div>
        @endif

        <input type="password" id="password_input" name="password" placeholder="パスワード">

        
        <button type="submit">ログイン</button>
        <p><a href="{{ route('setting') }}">新規登録はこちら</a></p>
    </form>
</body>
</html>
