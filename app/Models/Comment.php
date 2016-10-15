<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    function article(){
        return $this->belongsTo('App\Models\Article');
    }

    function user(){
        return $this->belongsTo('App\User');
    }

    public function comment_replies(){
        return $this->hasMany('App\Models\Comment_Replies');
    }
}
