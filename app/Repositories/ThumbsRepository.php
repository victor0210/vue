<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2017/3/6
 * Time: 20:58
 */

namespace App\Repositories;


use App\Models\Thumbs;
use Auth;

class ThumbsRepository
{
    public function isThumb($article_id){
        return !!Thumbs::where(['article_id' => $article_id, 'user_id' => Auth::user()->id])->first();
    }
}