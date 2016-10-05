<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    function comment()
    {
        return $this->hasMany('Article\Models\Comment');
    }

    public function Records(){
        return $this->hasMany('Article\Models\Records');
    }
}
