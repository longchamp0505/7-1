<!DOCTYPE html>
<html>
<head>
    <title>選手詳細画面</title>
    <link rel="stylesheet" href="{{ asset('css/player-detail.css') }}">
</head>
<body>

<h1 class="detail-title">■選手データ</h1>

<table class="detail-table">
    <tr><th>No</th><td>{{ $player->id }}</td></tr>
    <tr><th>背番号</th><td>{{ $player->uniform_num }}</td></tr>
    <tr><th>ポジション</th><td>{{ $player->position }}</td></tr>
    <tr><th>名前</th><td>{{ $player->name }}</td></tr>
    <tr><th>所属</th><td>{{ $player->club }}</td></tr>
    <tr><th>誕生日</th><td>{{ $player->birth }}</td></tr>
    <tr><th>身長</th><td>{{ $player->height }}</td></tr>
    <tr><th>体重</th><td>{{ $player->weight }}</td></tr>

    {{-- 総得点 --}}
    <tr>
        <th>総得点</th>
        <td>
             @if ($player->goals->count() > 0)
                <ul>
                    {{ $player->goals->count() }} 点
                </ul>
            @else
                無得点です。
            @endif
        </td>
    </tr>

    {{-- 得点履歴 --}}
    <tr>
        <th>得点履歴</th>
        <td>
            @foreach ($player->goals->sortBy('goal_time')->values() as $index => $goal)
                <li>
                    {{ $goal->pairing->kickoff }}開始 
                    {{ $goal->pairing->enemyCountry->name }}戦
                    {{ $goal->goal_time }}:
                    {{ $index + 1 }}点目
                </li>
            @endforeach
        </td>
    </tr>
</table>

<div class="back-index">
    <a href="{{ route('players.index') }}">戻る</a>
</div>

</body>
</html>