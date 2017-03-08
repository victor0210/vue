<?php
namespace App\Checkers;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;

/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2017/3/8
 * Time: 13:03
 */
class UserChecker
{
    public static function isAdmin(){
        return Auth::user()->isAdmin();
    }

    public static function ifCanDelete($article_id){
        return Auth::user()->id == Article::find($article_id)->user_id || Auth::user()->is_admin == 1;
    }
}