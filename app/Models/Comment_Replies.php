<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2016/10/15
 * Time: 17:28
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Comment_Replies extends Model
{
    public $table = "comment_replies";
    public function sender(){
        return $this->belongsTo('App\User','sender_id','id');
    }

    public function receiver(){
        return $this->belongsTo('App\User','receiver_id','id');
    }

    public function comment(){
        return $this->belongsTo('App\Models\Comment');
    }
}