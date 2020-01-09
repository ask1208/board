<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id','category_id', 'content', 'title'
    ];
        

    public function category(){
        return $this->belongsTo(\App\Category::class,'category_id');
    }

    public function user(){
        return $this->belongsTo(\App\User::class,'user_id');
    }
}
