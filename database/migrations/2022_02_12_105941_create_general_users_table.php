<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_users', function (Blueprint $table) {
            $table->id();
            $table->string('user_name', 64)->nullable()->comment('ユーザー名');
            $table->string('email');
            $table->string('password')->nullable()->comment('パスワード');
            $table->string('company_name', 64)->nullable()->comment('会社名');
            $table->string('url1')->nullable()->comment('掲載したいURL1');
            $table->string('url2')->nullable()->comment('掲載したいURL2');
            $table->string('url3')->nullable()->comment('掲載したいURL3');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_users');
    }
}
