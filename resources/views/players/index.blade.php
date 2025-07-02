<!DOCTYPE html>
<html>
<head>
    <title>選手データ</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<h1>■選手データ</h1>

<table>
    <thead>
        <tr class="header-row">
            <th>No</th>
            <th>背番号</th>
            <th>ポジション</th>
            <th>所属</th>
            <th>名前</th>
            <th>国</th>
            <th>誕生日</th>
            <th>身長</th>
            <th>体重</th>
            <th> </th>
            <th> </th>
            <th> </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($players as $player)
            <tr>
                <td>{{ $player->id }}</td>
                <td>{{ $player->uniform_num }}</td>
                <td>{{ $player->position }}</td>
                <td>{{ $player->club }}</td>
                <td>{{ $player->name }}</td>
                <td>{{ $player->country->name }}</td>
                <td>{{ $player->birth }}</td>
                <td>{{ $player->height }}</td>
                <td>{{ $player->weight }}</td>
                {{-- 詳細ボタン --}}
                <td>
                    <a href="{{ route('players.show', $player->id) }}"
                    class="action-button detail-button">詳細</a>
                </td>

                {{-- 編集ボタン --}}
                <td>
                    <a href="{{ route('players.edit', $player->id) }}"
                    class="action-button edit-button">編集</a>
                </td>

                {{-- 削除ボタン --}}
                <td>
                    <form method="POST"
                        action="{{ route('players.destroy', $player->id) }}"
                        class="delete-form"
                        onsubmit="return confirm('この選手データを削除しますか？');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-button delete-button">削除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="pagination-container">
    {{ $players->links('vendor.pagination.simple') }}
</div>

</body>
</html>
