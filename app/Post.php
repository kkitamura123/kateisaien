<?php
//このPostModel以外で使用する際はApp\Postで使用ができる
namespace App;
use App\Photo; //クラス名
// 注意：なぜすでに継承しているのか？
// 元々Laravelが提供しているモデルが存在をしている
// だからclass Posts extends Modelという表記になる
// (例)継承
// class A
//      public $x;
//      public $x_a;
//      function y(){
//      function y_a(){
// class B
//      public $x;
//      public $x_b;
//      function y(){
//      function y_b(){
// 重複している$xとy()の１つのクラスに抜き出す
// classs C
//      public $x;
//      function y(){
// このクラスCを継承extendsすることで同じ機能を持たせたクラスAとクラスBが作成可能
// class A extends C {
//      public $x_a;
//      function y_a(){
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // なぜuser()なのか　単数形なのか？
    // belongsTo Postモデルには１つだけUserが関連ついている
    public function user(){
        return $this->belongsTo(User::class);

    }
    
    // なぜphotosなのか？複数形なのか
    // hasmany Postモデルには複数のPhotoが関連ついている
    public function photos(){
        return $this->hasMany(Photo::class);
        // $postでphotosが呼ばれる
    }
}
