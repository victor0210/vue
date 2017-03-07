<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2017/3/7
 * Time: 22:33
 */

namespace App\Services;


use App\Models\Records;

class RecordService
{
    public function deleteByArticle($article_id){
        Records::where('article_id', $article_id)->delete();
    }
}