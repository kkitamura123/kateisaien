<header class="mb-4">
    {{-- navbar-expand-画面サイズ navbr-darkは暗い色(他/navbar-right)
         bg-darkはbarの色を変更(他/infoは青 dangerは赤)
         smはタブレットサイズ
    --}}
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        {{-- トップページのリンク --}}
        {{-- bavbar-brandは文字強調 --}}
        <a class="navbar-brand" href="/">家庭菜園</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                {{-- Auth::check()はユーザがログインしているか調べるための関数 --}}
                @if (Auth::check() )
                {{-- メッセージ作成ページへのリンク --}}
                {{-- 第一引数：ルーティング
                     第二引数：リンクにしたい文字
                     第三引数：/message/{message}の{message}の様なURL内のパラメータに代入したい値を指定
                     第四引数：HTMLタグの属性を配列形式で指定
                --}}
                <li class="nav-item">{!! link_to_route('posts.create','新規のメッセージ投稿', [],['class' => 'nav-link']) !!}</li>
                <li class="nav-item">{!! link_to_route('logout.get', 'Logout', [], ['class' => 'nav-link']) !!}</li>
                <li class="nav-item">{!! link_to_route('link', 'LINK', []) !!}</li>
                @else
                {{-- ユーザ登録ページへのリンク --}}
                <li class="nav-item">{!! link_to_route('signup.get', 'Signup', [], ['class' => 'nav-link']) !!}</li>
                {{-- ログインページのリンク --}}
                <li class="nav-item">{!! link_to_route('login', 'Login', [], ['class' => 'nav-link']) !!}</li>
                
                @endif
            </ul>
        </div>
    </nav>
</header>
