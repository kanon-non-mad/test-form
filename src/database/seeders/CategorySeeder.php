<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    // 外部キー制約を一時停止
    DB::statement('SET FOREIGN_KEY_CHECKS=0');

    // categories テーブルを truncate
    DB::table('categories')->truncate();

    // もう一度制約を戻す
    DB::statement('SET FOREIGN_KEY_CHECKS=1');

    // 通常の seed 処理（例：factory でレコードを作成）
        $categories =[
            ['content' => '商品のお届について'],
            ['content' => '商品の交換について'],
            ['content' => '商品トラブル'],
            ['content' => 'ショップへのお問い合わせ'],
            ['content' => 'その他'],
        ];

        DB::table('categories')->insert($categories);
    }
}
