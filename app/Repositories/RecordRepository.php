<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2017/3/6
 * Time: 20:47
 */

namespace App\Repositories;


use App\Models\Article;
use App\Models\Records;
use Auth;

class RecordRepository
{
    public function isEmptyWithArticle($article_id){
        return Records::where(['article_id' => $article_id, 'user_id' => Auth::user()->id])->get()->isEmpty();
    }

    public function addRecord($article_id){
        Records::insert([
            'user_id' => Auth::user()->id,
            'article_id' => $article_id,
            'belong' => Article::find($article_id)->user->id,
            'created_at' => gmdate('Y-m-d H:i:s'),
            'updated_at' => gmdate('Y-m-d H:i:s')
        ]);
    }
    public function updateRecordWithArticle($article_id){
        Records::where(['article_id' => $article_id, 'user_id' => Auth::user()->id])->update(['updated_at' => gmdate('Y-m-d H:i:s')]);
    }
}