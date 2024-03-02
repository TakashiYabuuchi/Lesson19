<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// use宣言追加（データベース）
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Postsテーブル初期レコード
        DB::table('posts')->insert([
        ['id' => '1','user_id' => '1','user_name' => 'A','contents' => 'Hello']
    ]);
    }
}
