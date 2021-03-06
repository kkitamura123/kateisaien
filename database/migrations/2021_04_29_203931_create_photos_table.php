<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('post_id');
            //画像をファイルに入れる ファイルまでのパス
            // nullを許容するにはnullable()を使用 NULL値設定可能(nullable)
            $table->string('photo_url')->nullable();
            $table->timestamps();
            
            // 外部キー制約 存在しない投稿には画像がつかない　 onDelete('cascade')=一緒にpostが削除
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photos');
    }
}
