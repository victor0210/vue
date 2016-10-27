<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 16/9/28
 * Time: 22:34
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Records extends Model
{
    function article(){
        return $this->belongsTo('App\Models\Article','article_id','id');
    }

    function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
}