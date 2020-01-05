<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fullable = [
    'user_id','content','category_id','title'
    ];

    public function category(){
        return $this->belongsTo(\App\Category::class,'category_id');
    }
}
