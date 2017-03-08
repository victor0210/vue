<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2017/3/8
 * Time: 15:36
 */

namespace App\Services;


use App\Models\Article;
use App\Models\Thumbs;
use App\Notifications\Thumb;
use App\User;
use Illuminate\Support\Facades\Auth;

class ThumbService
{
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