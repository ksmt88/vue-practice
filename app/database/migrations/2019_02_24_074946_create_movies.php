<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50)->comment("動画タイトル");
            $table->string('description', 255)->comment("動画紹介文");
            $table->string('time', 10)->comment("動画時間（mm:ss）");
            $table->smallInteger('category', false, true)->comment("カテゴリID");
            $table->string('url', 255)->comment("iframe埋め込み用URL");
            $table->string('thumbnail_url', 255)->comment("サムネイルのURL");
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
        Schema::dropIfExists('movies');
    }
}
