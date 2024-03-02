<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// use宣言追加（データベース）
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    //Usersテーブル設定
    Schema::create('users', function (Blueprint $table) {
    $table->integer('id')->autoIncrement()->onDelete('cascade');
    $table->string('name',255)->unique();
    $table->string('email',255)->unique();
    $table->string('password',255);
    $table->text('bio')->nullable();
    $table->text('image_name')->nullable();
    $table->text('image_path')->nullable()->default('default.png');
    $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
    $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
