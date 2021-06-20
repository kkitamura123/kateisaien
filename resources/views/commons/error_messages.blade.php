{{-- バリデーションエラーで自動的に元のページにリダイレクトし$errors変数に
     エラーメッセージが格納される
     View側で$errorsがあるか確認 あれば表示する処理を追加
     $errorsと複数形で書いてあるのは複数のエラーの保存
--}}
@if (count($errors) >0)
    <ul class="alert alert-danger" role="alert">
        @foreach ($errors->all() as $error)
            <li class="ml-4">{{ $error }}</li>
        @endforeach
    </ul>
@endif