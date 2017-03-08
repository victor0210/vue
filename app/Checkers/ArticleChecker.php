<?php
namespace App\Checkers;
use App\Models\Article;

/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2017/3/8
 * Time: 13:00
 */
class ArticleChecker
{
    public static function isExist($id){
        return !!Article::find($id)->get();
    }
    public static function isValidate($id) {
        return !!Article::where(['id' => $id, 'isValidated' => true])->get();
    }
}