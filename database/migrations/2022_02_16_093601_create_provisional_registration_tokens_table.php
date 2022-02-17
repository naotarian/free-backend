<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvisionalRegistrationTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provisional_registration_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('token')->unique()->nullable()->comment('認証用トークン');
            $table->string('user_name', 64)->nullable()->comment('ユーザー名');
            $table->string('email');
            $table->string('password')->nullable()->comment('パスワード');
            $table->string('account_type')->nullable()->comment('アカウントタイプ');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provisional_registration_tokens');
    }
}
