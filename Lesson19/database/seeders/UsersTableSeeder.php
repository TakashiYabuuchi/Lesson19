<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// use宣言追加（データベース）
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Usersテーブル初期レコード
         DB::table('users')->insert([
        ['name'=>'A','email'=>'a@a','password'=>bcrypt('aaaaaa'),'image_path'=>'default.png']
        ]);
    }
}
