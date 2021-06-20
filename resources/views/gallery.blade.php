@extends('layouts.app')
@section('content')
ここはgallery.blade.phpです
<h1>ここからGarllayです</h1>
<div id="contents">
        <h2>GALLERY</h2>
        

        
@foreach ($photos as $photo )
    <div class="list">
        <img src="{{ $photo->photo_url }}">
        <h4>見出しを入れます</h4>
        <p>説明を入れます</p>        
    </div>
@endforeach
{{--
        <h4>見出しを入れる</h4>
        <p>説明を入れます</p>
        </div>
        
        <div class="list">
        <img src="images/sample2.jpg">
        <h4>見出しを入れます</h4>
        <p>説明を入れます</p>
        </div>
        
        <div class="list">
        <img src="images/sample3.jpg">
        <h4>見出しを入れます</h4>
        <p>説明を入れます</p>        
        </div>
        
        <div class="list">
        <img src="images/sample4.jpg">
        <h4>見出しを入れます</h4>
        <p>説明を入れます</p>             
        </div>
        
        <div class="list">
        <img src="images/sample5.jpg">
        <h4>見出しを入れます</h4>
        <p>説明を入れます</p>    
        </div>
--}}
</div>  
@endsection