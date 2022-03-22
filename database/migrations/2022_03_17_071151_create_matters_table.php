<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMattersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matters', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->comment('ユーザーID');
            $table->boolean('is_display')->nullable()->default(1)->comment('0: 非表示, 1: 表示');
            $table->integer('occupation_id')->nullable()->comment('職種ID');
            $table->integer('occupation_detail_id')->nullable()->comment('職種詳細ID');
            $table->string('title', 128)->nullable()->comment('タイトル');
            $table->string('sub_title_1', 128)->nullable()->comment('サブタイトル1');
            $table->text('content_1')->nullable()->comment('内容テキスト1');
            $table->string('image_1')->nullable()->comment('画像ファイル名1');
            $table->string('sub_title_2', 128)->nullable()->comment('サブタイトル2');
            $table->text('content_2')->nullable()->comment('内容テキスト2');
            $table->string('image_2')->nullable()->comment('画像ファイル名2');
            $table->string('sub_title_3', 128)->nullable()->comment('サブタイトル3');
            $table->text('content_3')->nullable()->comment('内容テキスト3');
            $table->string('image_3')->nullable()->comment('画像ファイル名3');
            $table->string('sub_title_4', 128)->nullable()->comment('サブタイトル4');
            $table->text('content_4')->nullable()->comment('内容テキスト4');
            $table->string('image_4')->nullable()->comment('画像ファイル名4');
            $table->string('sub_title_5', 128)->nullable()->comment('サブタイトル5');
            $table->text('content_5')->nullable()->comment('内容テキスト5');
            $table->string('image_5')->nullable()->comment('画像ファイル名5');
            $table->string('sub_title_6', 128)->nullable()->comment('サブタイトル6');
            $table->text('content_6')->nullable()->comment('内容テキスト6');
            $table->string('image_6')->nullable()->comment('画像ファイル名6');
            $table->string('sub_title_7', 128)->nullable()->comment('サブタイトル7');
            $table->text('content_7')->nullable()->comment('内容テキスト7');
            $table->string('image_7')->nullable()->comment('画像ファイル名7');
            $table->string('sub_title_8', 128)->nullable()->comment('サブタイトル8');
            $table->text('content_8')->nullable()->comment('内容テキスト8');
            $table->string('image_8')->nullable()->comment('画像ファイル名8');
            $table->string('sub_title_9', 128)->nullable()->comment('サブタイトル9');
            $table->text('content_9')->nullable()->comment('内容テキスト9');
            $table->string('image_9')->nullable()->comment('画像ファイル名9');
            $table->string('sub_title_10', 128)->nullable()->comment('サブタイトル10');
            $table->text('content_10')->nullable()->comment('内容テキスト10');
            $table->string('image_10')->nullable()->comment('画像ファイル名10');
            $table->integer('price')->nullable()->comment('料金');
            $table->integer('discount')->nullable()->comment('割引率');
            $table->date('publish_date')->nullable()->comment('公開日');
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
        Schema::dropIfExists('matters');
    }
}
