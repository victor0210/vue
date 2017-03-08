<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2017/3/7
 * Time: 22:33
 */

namespace App\Services;


use App\Library\Page;
use App\Models\Article;
use App\Models\Records;
use Illuminate\Support\Facades\Auth;

class RecordService
{
    public function deleteByArticle($article_id)
    {
        Records::where('article_id', $article_id)->delete();
    }

    public function add($article_id)
    {
        Records::insert([
            'user_id' => Auth::user()->id,
            'article_id' => $article_id,
            'belong' => Article::find($article_id)->user_id,
            'created_at' => gmdate('Y-m-d H:i:s'),
            'updated_at' => gmdate('Y-m-d H:i:s')
        ]);
    }

    public function update($article_id)
    {
        Records::where(['article_id' => $article_id, 'user_id' => Auth::user()->id])->update(['updated_at' => gmdate('Y-m-d H:i:s')]);
    }

    public function getWithBelong($user_id, $record_num)  //get other user's record
    {
        return Records::orderBy('updated_at', 'desc')->where('belong', $user_id)->limit($record_num)->get();
    }

    public function getWithSelf()  //get own's record
    {
        $records = Records::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(Page::User_Center_Record_Page_Num);
        foreach ($records as $record) {
            $record->title = Article::where('id', $record->article_id)->value('title');
        }
        return $records;
    }
}