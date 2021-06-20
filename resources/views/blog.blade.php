@extends('layouts.app')
@section('content')


    {{--この中に文字が @yield('content')に反映される --}}
    【これはblog.blade.phpのページ】
    <br>
    送信するとstoreアクションに入力内容が送信される
    {{-- {{ }}はhtmlspecialcharas関数 --}}
    {{-- {!!,!!}}はそのまま出力される --}}    
    
    <h1>記事投稿　新規作成ページ</h1>
    {{-- row 横列が見出しであることを示す --}}
    <div class="row">
        {{-- bootstrap (例)col-画面サイズ-3(3カラム分の幅)  colは画面  --}}
        {{-- bootstrapはグリッドシステムで 横幅全体が12カラムに分かれている --}}
        <div class="col-6">
            {{-- フォームのコーディング方法 --}}
            {{-- まずForm::model()でフォームを開始 Form::close()でフォーム終了 <form>と</form>タグに対応している --}}
            {{-- Form::modelには第1引数には対象となるModelのインスタンスをとり 第2引数には連想配列を取る --}}
            {{-- 連想配列：'route' => 'posts.store'では 'route' => ルーティング名　としてformタグのaction属性の設定を行なっています --}}
            {{-- action属性を'posts.store'にしているのは このPOSTメソッドのフォームを受け取って処理するのがPostsControllerのstoreアクション --}}
            {{-- $postはcreateアクションで定義($post = new Post;) --}}
            {{-- storeアクションに移動 'route' => 'posts.store'--}}
            {!! Form::model($post, ['route' => 'posts.store']) !!}
                {{-- 2021_04_29_203713_create_posts_table --}}
                {{-- $table->string('title');             --}}
                <div class="form-group">
                    {!! Form::label('title', 'タイトル：') !!}
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                </div>
            
                {{-- 2021_04_29_203713_create_posts_table --}}
                {{-- $table->longtext('content');         --}}
                <div class="form-group">
                    {{-- フォーム作成はFormファサードを使用 --}}
                    {{-- LaravelのFormファサードを使用するとHTMLフォームタグがスッキリする --}}
                    {{-- 投稿内容：の隣にボックスができる --}}
                    {{-- 第一引数：'content'カラム
                         第二引数：ラベル名
                    --}}
                    {!! Form::label('content','投稿内容：') !!}
                    {{-- Form::text()は <input type="text">のボックスを生成 --}}
                    {{-- 第2引数にはテキストボックスに入れたい固定の初期値(不要ならnull)  --}}
                    {{-- 第3引数はタグの属性情報を配列形式で指定 --}}
                    {{-- 他にもinput要素を生成するための関数は --}}
                    {{-- Form::password(),Form::email(),Form::select(),Form::checkbox(),Form::radio() --}}
                    {{-- テキストボックスができる --}}
                    {!! Form::text('content', null, ['class' => 'form-control']) !!}
                </div>
                {{--　投稿ボタンができる --}}
                {{-- Form::submit('投稿')は送信ボタンを生成する関数 第1引数にはボタンへ描かれる表示内容を与える --}}
                {{-- 送信すると Form::model($post,['route' => 'posts.store'])のrouteで指定されたaction属性へフォームの入力内容が送られる --}}
                ↓storeアクションに移動<br>
                {!! Form::submit('投稿',['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>

@endsection