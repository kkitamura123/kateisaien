<?php
//【LaravelはURL -> ルーティング -> コントローラー -> ビューの順番で動作する】

// Controllerはユーザから送信されたHTTPリクエストの処理を担当する機能
// ControllerはHTTPリクエストに対応したModelの取得や作成、保存を行う
// Routerと対応しているControllerの関数のことをアクションと呼ぶ

// 記載のルール
// バリデーションはまず最初に書く


namespace App\Http\Controllers;
use Illuminate\Http\Request;
//このコントローラはApp\PostのModel操作が主になる
use App\Post;
use App\Photo;
use Illuminate\Support\Facades\Storage;

//作成の際にphp artisan make:controller MessagesController --resourceで作成
//--resourceをつけてmake:controllerで作成されたControllerは7つのルーティングに対応した7つのアクションが入っている
//この形をRESTful Resource Controllerと呼ぶ
//RESTfulはURLに対して取得GET/新規登録POST/更新PUT/削除DELETEのHTTPリクエストメソッドに応じて実行
//メッセージの個別詳細ページ表示Route::get('posrs/{id}', 'PostsController@show');の{id}はposts/1の場合 webサーバはユーザがidの1メッセをクリックしたと短段
// ルーティングエラーが出たらphp artisan route:listで調べる


//postsの7つのアクションの中でViewが必要なのはGETメソッドの4つのみ(index,create,show,edit)(store,update,destroyはviewはない)
class PostsController extends Controller
{
    //Postのレコードの一覧表示
    //全てのレコードを取得 = App\Post::all()
    //一覧表示
    //indexアクションはただの関数
    public function index()
    {
        // if(\Auth::check()){
        //     $user = \Auth::user();
        //     // ログイン者のみ閲覧が可能
        //     $posts = $user->posts()->get();

        //Post::all()は投稿一覧表示
        //$postsは単なる変数 = なんでも問題ない $testでもいい
        //Postモデルクラス postsテーブルと同じ
        //Postモデルとpostsテーブルは同じ
        $posts = Post::all();
        
        
        //前提：ContorollerとViewは別ファイルになる 別ファイルの場合,変数は引き継がれない
        // $posts = Post::all();でControllerに定義する 
        // 'posts'はviewで呼び出す時の名前 使用する時は$postsで使用可能
        // index.blade内の'posts'
        // return呼び戻す viewディレクトリ内postsディレクトリのindex.blade
        // 第一引数：表示したいViewを指定
        // 第二引数：指定のViewに私たいデータの配列を指定
        // 連想配列形式にして第二引数をセットする必要がある
        // ['posts' => $posts] 
        // 左側/Viewファイルで呼び出す変数名$posts 
        // 右側/コントローラー内で生成した変数$postsをセットする
        // return view('posts.index'[ 'posts' => $posts, ]);
        return view('posts.index',[
            //ルール：'posts'(どの名前でviewで使用するか？) => $posts(どんな情報をviewに渡すか？) 
            //$postsの中のデータを viewでは$postsと言う変数名で使用できる仕様
            //'post'はView内で使える様に設定したもの
            //例えば'test' => $posts と設定した際はViewでは$testsという変数名で使用出来る($posts = Post::all();を指す)
            //$posts = Post::all();とview内での$postsは一緒 ただしPostsController内では'posts'と表記する
            //'posts'イコール( $posts = Post::all(); )イコール$postsでもある
            //複数形の理由：一覧表示画面だから複数の投稿データを扱うから複数形のpostsになる
            'posts' => $posts,
            ]);
    }

    //新規作成して保存
    //新規登録画面表示処理
    //新規作成のフォーム表示
    public function create()
    {
        // 注意：この$postはindex.blade.phpの$postとは違うので注意
        // 上記にpublic function index()関数とは全く繋がり自体はない
        // 関数を新しく定義という認識でいい
        // インスタンスの作成
        // Postクラスからインスタンスの作成の方法は new クラス名()
        // オブジェクト指向：クラスを定義してデータ(プロパティ)と動作(メソッド)を持たせる事
        // 記載方法:$post = new Post();　でも　$post = new Post;でもどちらでも良い
        // インスタンスの作成は
        // <?php
        //      class Slime{                    
        //      public $type = 'スライム'
        //      $slime_A = new Slime();
        // 今回の場合
        // <?php
        //      class post extends Model (Posts.phpから)
        //      public function create() (PostsController.phpから)
        //      $post = new Post;        (PostsController.phpから)
        $post = new Post;
        

        return view('posts.create', [
            // 'post'はViewでも$postとして使える塔に
            // indexアクションでは複数形でcreateアクションが単数系な理由はcreateは１投稿データの単数操作だから
            // create.bladeでも$post = new Post;を使用できる様にする
            'post' => $post,
        ]);
    }
    
    // 新規登録処理
    // 新規作成のデータ保存
    // storeアクションではcreateのページから送信されるフォームを処理する 
    // 送られてきたフォーム内容は$requestに入っている
    // $requestからcontentを取り出して新規作成した投稿記事インスタンスへ代入保存します 
    // Request：「タイプヒンティング」関数やメソッドに渡す引数の型を指定できる機能 $requestはRequest型である
    // $requestはcreate()の新規投稿から送信された内容を元にLaravelにとって生成されたRequestインスタンス
    public function store(Request $request) 
    {
        // デバック
        // dd($request);
        // $request->thefile;
        // dd($request->image);
        
        // バリデーション 空のメッセージを投稿するとエラーになるのでバリデーションする
        // データベース側ではcontentカラムにNOT NUll制約をかけている
        // $request->validate([ 'required|max:255' ]);
        // requiredはカラではない 255文字超えていないか？を検証している
        $request->validate([ 
            // マイグレーションファイル2021_04_29_203713_create_posts_table.php内の
            // $table->string('title'); タイトルの保存先としてVARCHER型で作成(varcher255なので255文字まで)
            'title' => 'required|max:255',
            'content' => 'required|max:255',
            // 'photo_url' => 'required',
        ]);
        
        // ここで$postを定義　インスタンスを作成
        // createアクションでも$post = new Post;を定義した理由は別物だから
        // (例)<?pho
        //      public $type = 'スライム'
        //      $slime_A new Slime();
        // クラスはPostクラス class Post
        // インスタンス：オブジェクトの設計図
        // class Post
        // public function store(Request)
        // $post = new Post; Postクラスの特徴を持ったインスタンスを作成
        $post = new Post;  //$postはこのstoreアクション内で生成したPostインスタンス
        $post->user_id = \Auth::id();        
        
        // マイグレーションファイル2021_04_29_203713_create_posts_table.php内の
        // $table->string('title');タイトルの保存先としてVARCHER型で作成する(varcher255なので255文字まで)
        $post->title = $request->title;
        
        // $post作成したインスタンスを使う
        // $post->contet は 新規作成したcreateアクションから届いた新規記事投稿インスタンスに代入
        // $request->content;　は　$requestからcontentを取り出す
        // $postは new Post;で生成したばかりなので contentプロパティは空っぽ
        // $requestの方はユーザが入力した値がcontentに入っている(create.blade.phpの新規投稿フォームで入力した値)
        $post->content = $request->content;
        // ここでPostの登録
        $post->save();

        $photo = new Photo;
        $photo->post_id = $post->id;
        $photo_url = $request->file('photo_url');
        if($request->hasFile('photo_url')){
            $path = Storage::disk('s3')->putfile('myprefix', $photo_url, 'public');
            $photo->photo_url = Storage::disk('s3')->url($path);
        }
        $photo->save();
        // トップページへリダイレクトさせる
        // viewを返さずに'/'へリダイレクト(自動でページ移動)
        // なのでViews\store.blade.phpは作成する必要がない
        return redirect('/');

    }
    
    // showアクションはindexアクションと似ている
    // レコード内容表示
    // 1件の詳細表示
    // 詳細表示
    // showアクションには$idの引数が与えられる /post/1 /post/4 というURLにアクセスされた時に $id=1 $id=4 のように代入される
    // $idが指定されているので$post = Post::findOrFail($id);によって１つだけ取得する
    // そのため$post変数も単数系の命名にしている
    public function show($id)
    {
        // idの値で投稿を検索して取得
        // $idで１つだけ取得
        // 変数名も単数形で命名$post
        // idの値で投稿を検索し取得
        $post = Post::findOrFail($id);
        
        // $postはPostモデルのpostsテーブル中のuser_id
        // \Auth::id()はログイン認証 現在認証されているユーザのID取得
        // if文の()の中はtrueのみ
        // if($post->user_id == 認証userID のみ正 ){ 処理を書く }
        // if($post->user_id == \Auth::id()){
        // メッセージ詳細ビューでそれを表示
        return view('posts.show',[
                // 'post'はViewでも$postでも使える様に
                // 取得するのは１つだけだから単数系
                // もし'test' => $post,とするとViewで使用出来るのは$test
                'post' => $post,
                ]);
    }

    //更新のフォーム
    //更新画面表示処理
    //既存レコード変更のフォーム表示
    public function edit($id)
    {
        // idの値でメッセージを検索して取得
        // すでにcontentが入っている edit.blade.phpの{!! Form::text('content') !!}
        $post = Post::findOrFail($id);
        
        // $post->user_id は投稿者のユーザid
        // \Auth::id()    は現在認証されているユーザのIDを取得
        if($post->user_id == \Auth::id()){
        // メッセージ編集ビューで$postを表示
        return view('posts.edit',[
            // View内edit.blade内でも使用できる様に'post'でedit.bladeに引き渡してる
            'post' => $post,
            ]);
        }else{
            return redirect('/');
        }

    }

    //更新
    //既存レコードの変更のデータ保存
    public function update(Request $request, $id)
    {
        // バリデーション
        // $request->validate([ 'content' => 'required|max:255' ]);
        $request->validate([
            // マイグレーションファイル2021_04_29_203713_create_posts_table.php内の
            // $table->string('title');タイトルの保存先としてVARCHER型で作成(varcher255なので255文字まで)
            'title' => 'required|max:255',
            // $table->longtext('content');投稿本文の保存先としてcontentカラムをlongtext型で作成
            'content' => 'required|max:255',
        ]);
        
        // idの値でメッセージを検索して取得
        $post = Post::findOrFail($id);
        
        // メッセージを更新
        // $table->string('title');
        // $request->titleは受信するリクエストに含まれる「タイトル」の値を取得
        $post->title = $request->title;
        // table->longtext('content');
        $post->content = $request->content;
        $post->save();

    // dd($request->hasFile('photo_url'));

        // $photo = new Photo; これは新しいレコードを作成
        $photo = $post->photos()->first();
        $photo->post_id = $post->id;
        $photo_url = $request->file('photo_url');
        if($request->hasFile('photo_url')){
            $path = Storage::disk('s3')->putfile('myprefix', $photo_url, 'public');
            $photo->photo_url = Storage::disk('s3')->url($path);
        }
        $photo->save();
        // トップページへ        
        
        // トップページへリダイレクトさせる
        // リダイレクトなのでViewは不要
        return redirect('/');
    }
    //削除 
    //既存レコードの削除
    public function destroy($id)
    {
        // idの値でメッセージを検索して取得
        $post = Post::findOrFail($id);
        
        if($post->user_id == \Auth::id()) {
        // メッセージ削除
        $post->delete();
        }
        // トップページへリダイレクト viewは不要
        return redirect('/');
    }
    
    public function imageDestroy($id)
    {
        $post = Post::findOrFail($id);
        if($post->user_id == \Auth::id()) 
        {
        $deletePhoto = $post->photos->photo_url;
        Storage::delete('posts/{post}/image' . $deletePhoto);
        // imageDestroyメソッドで $post = Post::findOrFail($id)と$postの取得が出来ている
        // これに紐づくphotosテーブルの取得は $photo = $post->photos()->first();
        $photo = $post->photos()->first();
        $photo->photo_url;
        Storage::disk('s3')->delete->photos->photo_url;
        $photo->delete;
        }
        return view('posts.edit',[ 'post' => $post ]);
    }
    // photosテーブルの取得
    // $photo = $post->photos()->firstで
    
    
    
    // ABOUTページに飛ぶ
    public function about() {
        return view('about');
    }
    // LINKページに飛ぶ
    public function link() {
        return view('link');
    }
    // public function gallery() {
    //     return view('gallery');
    // }
    public function gallery(Request $request) 
        {
        $photos = Photo::all();
        return view('gallery',['photos' => $photos]);
    }

    
    
}
