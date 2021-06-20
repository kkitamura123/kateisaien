ここはedit.blade.phpです
{{--【LaravelはURL -> ルーティング -> コントローラー -> ビューの順番で動作する】--}}
@extends('layouts.app')
@section('content')

    @if (count($errors) >0)
        <ul class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                <li class="ml-4">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <h1>id: {{ $post->id }} のメッセージ編集ページ</h1>
    @foreach ($post->photos as $photo )
        @if (!empty($photo->photo_url))
        <img class="post_img" width="300" height="300" src="{{ $photo->photo_url }}" alt="">
        @endif
    @endforeach
    <div class="row">
        <div class="col-6">
            {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'put', 'enctype' => "multipart/form-data"]) !!}
                <div class="form-group">
                    {!! Form::label('title','タイトル：') !!}
                    {!! Form::text('title', null,['class' => 'form-control']) !!}
                </div>
            
                <div class="form-group">
                    {!! Form::label('content', 'メッセージ：') !!} 
                    {!! Form::text('content', null, ['class' => 'form-control']) !!}
                </div>
                <div class="group">
                    <input type="file" name="photo_url">
                    @csrf
                    <input type="submit" value="アップロード">
                </div>
               {!! Form::close() !!}             
                
                {!! Form::model($post, ['route' => ['posts.image_destroy', $post->id], 'method' => 'delete',]) !!}
                <div class="group">
                    <label>削除<input type="text"></label>
                    <input type="submit" value="画像削除" >
                </div>
                {!! Form::close() !!}


        </div>
    </div>
@endsection
                {{-- {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!} --}}