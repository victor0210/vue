<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2017/3/8
 * Time: 17:49
 */

namespace App\Checkers;


use App\Models\Records;
use Illuminate\Support\Facades\Auth;

class RecordChecker
{
    public static function isEmpty($article_id){
        return Records::where(['article_id' => $article_id, 'user_id' => Auth::user()->id])->get()->isEmpty();
    }
}