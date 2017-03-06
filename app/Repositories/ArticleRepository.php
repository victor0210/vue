<?php
namespace App\Repositories;

/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2017/3/6
 * Time: 20:16
 */

use App\Models\Article;
use Auth;

class ArticleRepository
{
    public function exist($id)
    {
        return !!Article::find($id);
    }

    public function existWithValidate($id)
    {
        return Article::where(['id' => $id, 'isValidated' => true])->get()->isEmpty();
    }

    public function incrementView($id)
    {
        Article::find($id)->increment('view');
    }

    public function getArticle($id)
    {
        return Article::find($id);
    }

    public function getUserByArticle($id)
    {
        return Article::find($id)->user;
    }

    public function getUserId($id)
    {
        return Article::find($id)->user_id;
    }

    public function addArticle($title, $collection, $filename)
    {
        return !!Article::insert(
            [
                'user_id' => Auth::user()->id,
                'collection' => $collection,
                'title' => $title,
                'content' => $filename,
                'created_at' => gmdate('Y-m-d H:i:s'),
                'updated_at' => gmdate('Y-m-d H:i:s')
            ]);
    }

    public function addSearchIndex(){
        Article::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->first()->searchable();
    }
}