<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_name', 64)->nullable()->comment('ユーザー名');
            $table->string('email');
            $table->string('password')->nullable()->comment('パスワード');
            $table->integer('occupation_id')->nullable()->comment('職種ID');
            $table->integer('gender')->nullable()->comment('性別, 0:男性, 1:女性');
            $table->text('strength')->nullable()->comment('アピールポイント, 長所');
            $table->date('birth')->nullable()->comment('生年月日');
            $table->string('work_history_years', 16)->nullable()->comment('職種経験年数');
            $table->boolean('is_recruitment')->default(true)->comment('募集中フラグ, 0:停止中, 1:募集中');
            $table->string('url1')->nullable()->comment('掲載したいURL1');
            $table->string('url2')->nullable()->comment('掲載したいURL2');
            $table->string('url3')->nullable()->comment('掲載したいURL3');
            $table->string('account_type')->nullable()->comment('アカウントタイプ');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['email', 'deleted_at'], 'users_email_unique');
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
