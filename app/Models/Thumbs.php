<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2016/10/27
 * Time: 14:27
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Thumbs extends Model
{
    public $table = "thumbs";

    public function article()
    {
        return $this->belongsTo('App\Models\Article', 'article_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}