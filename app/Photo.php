<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    // なぜpost()　単数形のなのか？
    // Photoモデルには一つのPostが関連ついているため
    public function post()
    {
        // belongsToは所属
        return $this->belongsTo(Post::class);
    }
}
