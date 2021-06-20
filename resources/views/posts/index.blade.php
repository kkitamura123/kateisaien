{{--【LaravelはURL -> ルーティング -> コントローラー -> ビューの順番で動作する】--}}

{{--@マークはLaravel特有の記法--}}
{{--index.blade.phpがトップページになる--}}
{{--このページに@yield を入れる--}}
{{--@extendsはレイアウトの継承--}}
{{--@sectionは指定した名前でセクションが用意される--}}
{{--@foreachはforeach文に相当するもの--}}


{{--@extends('layouts.app')と記載しておけばapp.blade.phpのソースだけ変更したら
    全て(index create show edit.blade.php)反映される--}}
@extends('layouts.app')

@section('content')
{{--セクションはHTMLの塊を指す--}}
{{--(例) 
@section('test')
TEST
@endsection
と定義してたら
app.blade.phpの中の
@yield('test')と記載した所にTESTと表示される
--}}
{{--この間に@yield('content')の内容が書かれる--}}
         <div id="wrapper">
             <div id="main">
                 <section>
                     <h2>TechAcademy KITCHENについて</h2>
                     {{-- @foreach ($posts as $post) --}}{{-- $messagesから１件ずつ取り出して値を$messageに代入する--}}
                     {{-- \App\Post::all()から１件ずつ取り出して値を$postに代入する --}}
                     {{--   {{ $post->user->name }}の説明
                            １、\App\Post:all()の中身イメージ
                            [ 
                             {
                               id: 1
                               content: 'test1',
                               user_id: 3,
                               user   : { public function user()により取得出来る情報 }
                               id     : 3
                               name.  : tarou
                             }
                             {
                               id.    : 2,
                               content:'test2',
                               user_id: 4,
                               user.  : { public function user()により取得出来る情報 }
                               id.    : 4,
                               name.  : 'tarou'
                              }
                             
                             ２、$postの中身のイメージ
                             @foreach(\App\Post::all() as $post)により１の内容が１つづつ取り出せる。
                             そのため下記の情報が保存される
                             {
                                id:1
                                content: 'test1',
                                user_id: 3,
                                user.  : { public function user()により取得出来る情報
                                id.    : 3,
                                name.  : 'tarou',
                             }
                            ]
                            ３、$post->user->name
                            ２の中身のuserプロパティの下にあるnameプロパティを取り出すと言う意味になる
                            なので tarouと言う情報が取り出される
                     --}}
                     @foreach (\App\Post::all() as $post)

                     <section>
                         {{--
                        <img class="mr-2 rounded" src="{{ Gravatar::get($user->email, ['size' => 50]) }}" alt="">
                        --}}
                        <h2>{{ $post->user->name }}さんの投稿</h2>
                        <h3>{!! link_to_route('posts.show', $post->id, ['post' => $post->id]) !!}</h3>
                         <h3>{{ $post->title }}</h3>
                         <div class="point">
                             <p>

                                {{ $post->content }}                               
                             </p>
                           @foreach ( $post->photos as $photo )
                             <figure>
                                {{-- 画像投稿しない場合には画像は取得 表示しない --}}
                                @if (!empty($photo->photo_url))
                                {{--     {{ dd($post->photos) }} --}}
                                <img class="post_img" width="300" height="300" src="{{ $photo->photo_url }}" alt="">
                                @endif
                             </figure>
                            @endforeach
                         </div>
                     </section>
                     @endforeach
                 </section>
                 
                 <section id="news">
                     <h2>お知らせ</h2>
                     <ul>
                         <li>
                             <span>2018/09/01</span>
                             <a href="/">写真を追加しました</a>
                         </li>
                         <li>
                             <span>2018/08/24</span>
                             <a href="/">講座案内を更新しました</a>
                         </li>
                     </ul>
                 </section>
             </div>
             <aside id="sidebar">
                 <section id="sidebar">
                     <section id="side_banner">
                         <h2>関連リンク</h2>
                         <ul>
                             <li>
                                 <a href="/" target="_blank"><img src="images/banner01.jpg" alt=""></a>
                                 <p>毎日季節の野菜を取り入れたレシピを公開中。</p>
                             </li>
                         </ul>
                     </section>
                 </section>
             </aside>
         </div>




{{--
    【ここから下はindex.blade.phpのページ】
    <h1>投稿一覧</h1>
        {{-- もし投稿一覧が１つ以上あれば@foreachで$postを取り出す--}}
        {{-- PostsControllerのindexアクションで
             return view('posts.index',['posts' => $posts]);で
             View内index.bladeでも使用出来る様にしている
             $postsは投稿一覧
        --}}
{{--        @if (count($posts) > 0)
            {{-- table-stripedは一行おきに背景色をつける --}}
            {{-- 中央寄せ justify-content-center d-flex --}}
{{--            <div class="justify-content-center d-flex">
            <table class="col-8 table table-striped">
                <thead>{{-- 表の見出しとなる部分 表の一番上の部分 --}}
                    {{-- table row 横一列を書く時に使用 --}}
                    {{-- <tr style="height: 500px;"> --}}
{{--                    <tr>
                        <th>id</th>{{-- table head 見出しの内容を書く時に使用 --}}
{{--                        <th>タイトル</th>
                        <th>投稿</th>
                    </tr>
                </thead>
                <tbody>
                    {{--$postから一件ずつ取得していき最終的に全件表示--}}
                    {{--foreachで$postsを１つのレコードずつループ--}}
                    {{--$post = Post::all(); --}}
                    {{--(説明)foreach文 --}}
                    {{--<?php--}}
                    {{--    $fruits = ['リンゴ','バナナ','オレンジ','ブドウ','桃'];--}}    
                    {{--    foreach ($fruits as $fruit) {   --}}    
                    {{--           print $fruits .PHP_EOL;  --}}    
                    {{--    $fruitsから1件取得し,値を$fruitに代入する   --}}
                    {{--例えば$posts as $test でもいい--}}
{{--                    @foreach ($posts as $post)
                    <tr>
                    {{-- <tr style="height: 100px;"> --}}
                        {{-- idの一覧表示をする --}}
                        {{-- $postイコール１件ずつ表示という --}}
                        {{-- １件ずつ表示->idを：という意味になる　--}}
                        {{-- foreachのレコード取得ループの中でidを画面に出力--}}
                        {{-- メッセージ詳細ページへのリンク --}}
                        {{-- 第一引数:ルーティング
                             第二引数：リンクにしたい文字
                             第三引数：/message/{message}の{message}の様なURL内のパラメータに代入したい値を指定
                             第四引数：HTMLタグの属性を配列形式で指定
                        --}}
{{--                        <td>{!! link_to_route('posts.show',$post->id, ['post' => $post->id])  !!}</td>
                        {{--contentの一覧表示をする--}}
                        {{-- １件ずつ表示->contentを：という意味になる --}}
                        {{-- foreachのレコード取得ループの中でcontentを画面に出力--}}
                        {{-- $postイコール１件ずつ取得 --}}
                        {{-- https://gyazo.com/c6a91bb140400e305693dc01ba64ce62 の様な表示が出来る--}}
{{--                        <td>{{ $post->title }}</td>
                        <td>{{ $post->content }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        @endif
        {{-- index.blade.phpのViewからcreate.blade.phpのviewへの移動出来るリンクを作成 --}}
        {{-- PostsController.phpのpublic function create --}}
        {{-- Laravel collectiveのlink_to_route()関数 --}}
        {{-- 第1引数：ルーティング名 第2引数：リンクにしたい文字列 第3引数：URL内のパラメータに代入したい値を配列形式で指定 --}}
        {{-- パラメータとは：引数 http://hogehoge/test/?id=1の ?の後ろにあるidのことを指す--}}
        {{-- 入力ー処理ー出力の工程がある パラメータに値を入れると結果が変わる--}}
        {{-- link_to_routeはViewでのコーディングの記載の仕方 HTMLの<a href="hogeURL">XXX</a>に変換 リンクはRoute::getでのルーティング指定 --}}
        create.blade.phpに移行<br>
        @if(\Auth::check())
        {!! link_to_route('posts.create','新規記事の投稿',[],['class' => 'btn btn-primary']) !!}
        @endif
@endsection