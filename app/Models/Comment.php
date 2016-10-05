<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    function article(){
        return $this->belongsTos('APP\Models\Article');
    }
}
