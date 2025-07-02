<!DOCTYPE html>
<html>
<head>
    <title>選手編集画面</title>
    <link rel="stylesheet" href="{{ asset('css/player-edit.css') }}">
</head>
<body>

<div class="edit-container">
    {{-- 左端に合わせた見出し --}}
    <h1 class="edit-title">■選手データ</h1>

    {{-- フォームには外枠なし（margin/paddingだけ調整） --}}
    <form action="{{ route('players.update', $player->id) }}" method="POST">
        @csrf

        <table class="edit-table">
            <tr class="no-border">
                <th>No</th>
                <td><input id="id_number" type="text" value="{{ $player->id }}" readonly></td>
            </tr>
        <tr>
                <th>背番号</th>
                <td>
                    @if ($errors->has('uniform_num'))
                        <div class="error-message">{{ $errors->first('uniform_num') }}</div>
                    @endif
                    <input id="uniform_number" type="text" name="uniform_num" value="{{ old('uniform_num', $player->uniform_num) }}">
                </td>
            </tr>

            <tr>
                <th>ポジション</th>
                <td>
                    @if ($errors->has('position'))
                        <div class="error-message">{{ $errors->first('position') }}</div>
                    @endif
                    <select name="position" id="position">
                        @foreach ($positions as $position)
                            <option value="{{ $position }}" @if ($player->position === $position) selected @endif>{{ $position }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>

            <tr>
                <th>名前</th>
                <td>
                    @if ($errors->has('name'))
                        <div class="error-message">{{ $errors->first('name') }}</div>
                    @endif
                    <input id="player_name" type="text" name="name" value="{{ old('name', $player->name) }}">
                </td>
            </tr>

            <tr>
                <th>国</th>
                <td>
                    @if ($errors->has('country_id'))
                        <div class="error-message">{{ $errors->first('country_id') }}</div>
                    @endif
                    <select id="country_of_affiliation" name="country_id">
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}" @if ($country->id == $player->country_id) selected @endif>{{ $country->name }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>

            <tr>
                <th>所属</th>
                <td>
                    @if ($errors->has('club'))
                        <div class="error-message">{{ $errors->first('club') }}</div>
                    @endif
                    <input id="team_of_affiliation" type="text" name="club" value="{{ old('club', $player->club) }}">
                </td>
            </tr>

            <tr>
                <th>誕生日</th>
                <td>
                    @if ($errors->has('birth'))
                        <div class="error-message">{{ $errors->first('birth') }}</div>
                    @endif
                    <input id="birthday" type="date" name="birth" value="{{ old('birth', $player->birth) }}" placeholder="YYYY-MM-DD" pattern="\d{4}-\d{2}-\d{2}">
                </td>
            </tr>

            <tr>
                <th>身長</th>
                <td>
                    @if ($errors->has('height'))
                        <div class="error-message">{{ $errors->first('height') }}</div>
                    @endif
                    <input id="body_height" type="text" name="height" value="{{ old('height', $player->height) }}">
                </td>
            </tr>

            <tr>
                <th>体重</th>
                <td>
                    @if ($errors->has('weight'))
                        <div class="error-message">{{ $errors->first('weight') }}</div>
                    @endif
                    <input id="body_weight" type="text" name="weight" value="{{ old('weight', $player->weight) }}">
                </td>
            </tr>
        </table>



        <div class="button-area">
            <button id="player_edit_button" type="submit">編集</button>
            <a id="player_back_button" href="{{ route('players.show', $player->id) }}">戻る</a>
        </div>
    </form>
</div>

</body>
</html>
