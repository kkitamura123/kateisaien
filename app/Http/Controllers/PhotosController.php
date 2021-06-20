<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Photo;
use Storage;

class PhotosController extends Controller
{
    public function add()
    {
        return view('posts.create');    
    }
    public function create(Request $request)
    {
        $photo = new Photo;
        $form = $request->all();
        
        // s3アップロード開始
        $image = $request->file('image');
        // バッケトの myprefixフォルダへアップロード
        $path = Srorage::disk('s3')->putFile('myprefix', $image, 'public');
        // アップロードした画像のフルパスを取得
        $photo->photo_url = Storage::disk('s3')->url($path);
        
        $photo->save();
        
        return redirect('photos/create');
    }
}
