【下記はapp.blade.phpです】
{{--【LaravelはURL -> ルーティング -> コントローラー -> ビューの順番で動作する】--}}


{{--app.blade.phpに集約をする--}}
<!DOCTYPE html>
{{-- jaは日本語として表示 --}}
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>家庭菜園ライフ</title>
        <!--viewportはスマホタブレットでも表示を最適化させる-->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        {{-- Bootstrapのリンク これがないと作動しない --}}
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('CSS/kateisaien.css') }}">
    </head>
    <body>
        <header>
        {{-- <h1><img class="logo" src="images/logo.png" alt="logo"></h1> 
             この状態だと一部にしか反映されないので
             asset関数を使う publicディレクトリからの相対パスを引数に与えると実際のURLフルパスを生成してくれる
             <hi><img class="logo" src="{{ asset('imges/logo.png') }}" alt="logo"></h1>で生成できる
        --}}
        </nav>
         <h1><img class="logo" src="{{ asset('images/logo.png') }}" alt="logo"></h1>
         <header>
             <h1><img src="images/logo1.png" alt=""></h1>
             <nav id="global_navi">
                 <ul>
                    {{-- <li><a href="{{ asset('blog.html') }}">記事投稿</a></li> --}}
                     {{-- 第一引数はルーティング php artisan route:listで posts.createを探す
                        　App\Http\Controllers\PostsController@create createアクションと分かる --}}
                    <li>{!! link_to_route('posts.index', 'HOME', []) !!}</li>
                    <li>{!! link_to_route('posts.create','記事投稿',[]) !!}</li>
                    <li>{!! link_to_route('about','ABOUT',[]) !!}</li>
                    <li>{!! link_to_route('gallery', 'GALLERY', []) !!}</li>
                    <li>{!! link_to_route('link', 'LINK', []) !!}</li>
                 </ul>
             </nav>
             
         </header>
         <div id="main_visual">
             <img src={{ asset('images/main_visual.jpg') }} alt="">
         </div>
        </header>
            <div class="conteiner">
            {{-- ナビゲーションバー --}}
            {{--  @includeは別に定義したbladeファイルの内容をそのまま取り込める --}}
            @include('commons.navbar')  
                
                {{-- この部分に
                     index.blade.php内の
                     @section('content')
                        ここが反映される( @yield('content') )
                     @endsection
                --}}
                {{-- エラーメッセージ --}}
                @include('commons.error_messages')
                
                @yield('content')
            </div>
            
        <footer>
             <div id="footer_navi">
                 <ul>
                    <li>{!! link_to_route('posts.index', 'HOME', []) !!}</li>
                    <li>{!! link_to_route('posts.create','記事投稿',[]) !!}</li>
                    <li>{!! link_to_route('about','ABOUT',[]) !!}</li>
                    <li>{!! link_to_route('gallery', 'GALLERY', []) !!}</li>
                    <li>{!! link_to_route('link', 'LINK', []) !!}</li>
                 </ul>
             </div>
             <small>&copy;2018 TechAcademy KITCHEN.</small>
        </footer>
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    </body>
</html>