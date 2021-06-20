<?php
//【LaravelはURL -> ルーティング -> コントローラー -> ビューの順番で動作する】
//最初にする事
//①LaravelCollective HTMLのインストール composer require laravelcollective/html:^6.0  PHPのコードでHTMLを作成してくれる
  //実行するとcomposer.jsonとcomposer.lockが自動的に更新される 
//開発の順：Model→Router→Controller→View
// Route::get('ルートのURL', 'コントローラー名@アクション名')->name('このルートの名称');

// Routeと言う関数は何をするためのもの？
// ルーティングの定義を元に「リンクのURL」を作成するための指定
// １、関数の意味を考える
// ２、関数の使い方を考える
// ３、1,2を元にして記述を考える




//routeはURLとコントローラーのアクションの対応ルール 対応ルールを作成する事をルーティングと呼ぶ
//このURLでアクセスされた際はこのControllerのアクションを呼び出す
//このファイルを見ればどのURLでどの処理が行われるかが理解できる
//Routeファサードを使用して記述 CURD GET POST PUT DELETE

// Route::get('/', function () {
//     return view('welcome');
// });
//トップページ'/'をPostsControllerのindexアクションに設定
//indexアクションはトップページ'/'にアクセスした時と /postsにアクセスした両方で同じルーティングが設定
// /postsバスにgetメソッドで来たリクエストをPostsController@indexで処理する。というルート定義
Route::get('/', 'PostsController@index');


//7つの基本ルーティング省略形
//CRUD,メッセの個別詳細ページ表示,メッセの新規登録を処理,メッセの更新処理,メッセ削除,
//index:showの補助ページ, create:新規作成用のフォームページ, edit:更新用のフォームページ
//'posts'は任意のURLのこと

Route::resource('posts', 'PostsController');


// Lesson15 Chapter6.2 Router
// ユーザ登録のControllerはRegisterController@showRegisterController
// ユーザ登録のルーティングをweb.phpに追加
// name() はこのルーティングに名前をつけているだけ
// 下記と連絡してるのはapp\Http\Controllers\Auth\RegisterController.php
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// 認証はLoginControllerが担当
// LoginController.php内のuse AuthenticatesUsers;はトレイトを使用
// Routerで設定したshowLoginFormやloginアクションはそこに定義されている
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');


Route::group(['middleware' => ['auth']], function() {
    // exceptは除く
    Route::resource('posts', 'PostsController', ['except' => ['index','show']] );
});
    // showだけはログインしていない状態でも
    Route::resource('posts', 'PostsController', ['only' => 'show']);
    
    
// Route::get('photo','PhotosController@create')->name('photo');    
Route::get('posts.store', 'PostsController@store')->name('posts.photo');   
Route::delete('posts/{post}/image', 'PostsController@imageDestroy')->name('posts.image_destroy');
    
    
Route::get('about',function(){
    return view('about');
})->name('about');
Route::get('link',function(){
    return view('link');
})->name('link');
// Route::get('gallery',function(){
//     return view('gallery');
// })->name('gallery');
// Route::get('about','PostsController@about')->name('about');
// Route::get('link', 'PostsController@link')->name('link');
Route::get('gallery', 'PostsController@gallery')->name('gallery');

// web.phpのルーテぅングは基本

// コントローラー通すは動的なサイト