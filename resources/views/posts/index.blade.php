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
@endsection