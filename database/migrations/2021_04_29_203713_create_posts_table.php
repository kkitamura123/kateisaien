<?php
//Laravelの名前空間にはIlluminateが付く
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //upメソッドはmigrationが実行された時に呼ばれる
    //up()では接続先のDBにpostsテーブルを作成しカラムをいくつか作成
    public function up() 
    {
        Schema::create('posts', function (Blueprint $table) {
            // 投稿の番号のid
            // photosテーブルのpost_idに投稿の番号(postsテーブルと同じ情報)を指定することで
            // 各photoがどのpostと関係しているかの保存
            $table->bigIncrements('id'); //自動連番
            $table->unsignedBigInteger('user_id');// unsgined符号なし 負の数はなく正の数のみ つまり0以上　BigIntegerは桁の大きい整数型
            $table->longText('content');//投稿本文の保存先としてcontentカラムをlongText型で作成
            $table->string('title');//タイトルの保存先としてVARCHAR型で作成す(varchar255なので225文字まで保存)
            $table->timestamps(); //投稿日時 created_at(作成日時) updated_at(更新日時)
            
            //外部キー制約 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    //downメソッドはmigrationがロールバックされた時に呼ばれる
    //postsテーブルが存在するなら(if exists) 削除する(drop)
    //exists=存在する
    //変更を元に戻すような操作をdown()に記述する
    public function down() 
    {
        Schema::dropIfExists('posts');
    }
}
