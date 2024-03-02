<?php
// postsテーブル作成
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// use宣言追加（データベース）
use Illuminate\Support\Facades\DB;

class Posts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    //postsテーブル設定
    Schema::create('posts',function(Blueprint $table){
    $table->integer('id')->autoIncrement();
    $table->integer('user_id');
    $table->foreign('user_id')->references('id')->on('users')->OnDelete('cascade');
    $table->string('user_name',255);
    $table->string('contents', 255);
    $table->timestamp('post_created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
    $table->timestamp('post_updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
    });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('posts');
    }
}
