<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2017/3/8
 * Time: 13:52
 */

namespace App\Checkers;


use App\Models\Thumbs;
use Illuminate\Support\Facades\Auth;

class ThumbChecker
{
    public static function isThumb($article_id){
        return !!Thumbs::where(['article_id' => $article_id, 'user_id' => Auth::user()->id])->first();
    }
}