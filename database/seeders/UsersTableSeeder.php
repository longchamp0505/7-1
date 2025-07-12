<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'country_id' => 0,                    // 管理者の特別な国ID（例）
            'email' => 'admin@example.com',      // 必須のメールアドレス
            'password' => Hash::make('admin'),// パスワードは必ずハッシュ化！
            'role' => 0,                         // 0=管理者、1=一般ユーザー
        ]);
    }
}
