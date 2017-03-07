<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2017/3/6
 * Time: 20:58
 */

namespace App\Repositories;


use App\Models\Article;
use App\Models\Thumbs;
use App\User;
use Auth;

class ThumbsRepository
{
    public function isThumb($article_id){
        return !!Thumbs::where(['article_id' => $article_id, 'user_id' => Auth::user()->id])->first();
    }

    public function addThumb($article_id){
        Thumbs::insert([
            'article_id' => $article_id,
            'user_id' => Auth::user()->id,
            'created_at' => gmdate('Y-m-d H:i:s'),
            'updated_at' => gmdate('Y-m-d H:i:s')
        ]);
        Article::find($article_id)->increment('thumb_up');
        User::find(Auth::user()->id)->notify(new Thumb(Auth::user(), Article::find($article_id)));
    }
}