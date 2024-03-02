<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// use宣言追加（データベース）
use Illuminate\Support\Facades\DB;


class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('followed_user_id');
            $table->integer('following_user_id');
            $table->foreign('followed_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('following_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamp('follow_created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('follow_updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follows');
    }
}
