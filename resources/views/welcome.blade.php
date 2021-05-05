<!DOCTYPE HTML>
<!--jaは日本語として表示-->
<html lang="ja">
<head>
    <meta charaset="UTF-8">
    <meta http-equiv="X-UA-Commpatible" content="IE=edge">
    <!--viewportはスマホタブレットでも表示を最適化させる-->
    <meta name="viewport" content="width=device-width, initinal-scale=1.0">
    <!--タブの名前-->
    <title>家庭菜園ライフ</title>
    <style>
    /*中央揃えtext-alignプロパティ  */
    header{
        text-align: center;
    }
    
    img{
        /*はみ出さないためのプロパティ/widthは横幅を示す  */
        /* max-widthは横幅の最大値を指定している */
        /* 画面がどれだけ小さくなっても個別の画面の幅を最大値にする */
        /* 画面をはみ出さない */
        max-width: 100%;
    }   
    /* クラスを指定する際はドットから始める */
    .logo{
    width: 600px;
    margin: 30px auto;
    }
    /* navタブの中のulタブ中のliタグ/指定してる場所がわかりやすくなる */
    /* navの外側にあるliタグは影響を受けない */
    nav ul li{
        /* ・が消える */
        list-style: nane;
        /* 横並びにする */
        display: inline;
    }
    nav{
        /* navタブを中央に揃える */
        text-align: center;
        /* ナビバーと「お知らせ」の余白を開かせる */
        margin-bottom: 30px;
    }
    nav li a{
        /* paddingは内側の余白 */
        /* padding: 15px 30px 15px 30pxの省略形がpadding: 15px 30x;  */
        /* padding: 上　右　下　左 */
        /* 重複部分は省略して良い */
        padding: 15px 30px;
        /* テキストのデザインを初期化する */
        text-decoration: nane;
        color: #666;
    }
    /* 擬似クラス */
    /* nav li a:hoverのコロンは忘れない */
    nav li a:hover{
    /* 下線を入れる */
    /* 4px=線の太さ　solid=線の種類 */
    /* 指定する順番は関係なし */
    border-bottom: 4px solid #d08047;
    }
    a{
    /* アニメーションの設定 */
    /* 状態の移り変わりを設定できる 0.3秒遅くする */ 
    transition: 0.3s;
    }
    </style>
</head>
</html>
<body>
    <header>
    <h1><img class="logo" src="images/logo.png" alt="logo"></h1>
    </header>
</body>
<nav>
    <ul>
    <li><a href="#">ホーム</a></li>
    <li><a href="#">投稿一覧</a></li>
    <li><a href="#">About</a></li>
    </ul>
</nav>