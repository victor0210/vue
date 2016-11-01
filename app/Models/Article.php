<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Article extends Model
{
    use Searchable;

    function comment()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function records()
    {
        return $this->hasMany('App\Models\Records');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function thumb()
    {
        return $this->hasMany('App\Models\Thumbs');
    }

    public function isValidated(){
        return $this->isValidated;
    }
}
