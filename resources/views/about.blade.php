@extends('layouts.app')
@section('content')
<div id="contents">
<section>
    <h1>ここからAboutページ</h1>
     <section>
     <h2>About</h2>
     <p>このサイトの説明ページ</p>
     
    <h2>tableサンプル</h2>
    <table class="ta1">    
    <caption>見出しが必要であればここを使用</caption>    
    <tr>
    <th>見出し</th>
    <td>ここに説明を入れる</td>
    </tr>
     <tr>
    <th>見出し</th>
    <td>ここに説明を入れる</td>
    </tr>
    <tr>
    <th>見出し</th>
    <td>ここに説明を入れる</td>
    </tr>
    </table>
</section>


<section id="about">
<h2>当サイトについて</h2>
<h3>サンプル</h3>
<p>サンプルテストサンプルテスト</p>

    <h2>当家庭菜園ホームページについて</h2>
    <p>当ホームページは家庭菜園の楽しさを共有するサイトです</p>   
    <h3></h3>
</section>
</div>

@endsection