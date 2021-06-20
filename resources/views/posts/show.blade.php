{{--【LaravelはURL -> ルーティング -> コントローラー -> ビューの順番で動作する】--}}
@extends('layouts.app')
@section('content')
ここはshow.blade.phpです
    {{-- $postは( $post = Post::findOrFail($id); )
         idの値で投稿を検索して取得
    --}}
    <h1>id = {{ $post->id }}のメッセージ詳細ページ</h1>
    {{-- table-borderedはボーダー付きのテーブル --}}
    <table class="table table-bordered">
        <tr>{{-- table row 横一列を書くときに使用 --}}
            {{-- table head 見出しの内容を書くときに使う　必須 --}}
            <th>id</th>
            {{-- table data 内容を書くときに使う --}}
            <td>{{ $post->id }}</td>
        </tr>
        <tr>{{-- table row 横一列の行 --}}
            <th>投稿内容</th>
            <td>{{ $post->content }}</td>
        </tr>
        @foreach( $post->photos as $photo )
            @if (!empty($photo->photo_url))
            <img class="post_img" width="300" height="300" src="{{ $photo->photo_url }}" alt="">
            @endif
        @endforeach
    </table>
    {{-- @if($post->user_id == \Auth::check() )   
         $post->user_id 
         \Auth::check　 ログインユーザは全員が見れる 
         Auth::id 　　　はログイン認証されたユーザのみ見れる --}}
    @if( $post->user_id == Auth::id() )
    {{-- edit.blade.php メッセージ編集ページのリンク --}}
    {{-- 第一引数：ルーティング
         第二引数：リンクにしたい文字
         第三引数：/message/{message}の{message}の様なURL内のパラメータに代入したい値を指定
         第四引数：HTMLタグの属性を配列形式で指定
    --}}
    {!! link_to_route('posts.edit', 'このメッセージを編集',['post' => $post->id], ['class' => 'btn btn-light']) !!}
    
    {{-- メッセージ削除フォーム --}}
    {{-- 第一引数：対象になるModelのインスタンス
         第二引数：連想配列.    --}}
    {!! Form::model($post, ['route' => ['posts.destroy', $post->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    @endif
    {!! Form::close() !!}
@endsection