<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2016/10/27
 * Time: 10:35
 */

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Records;
use App\User;
use YuanChao\Editor\EndaEditor;

class OtherUserController extends Controller
{
    public function index($id)
    {
        User::find($id)->increment('browse');
        $user = User::find($id);
        $articles = Article::where(['user_id' => $id])->paginate(3);
        foreach ($articles as $article) {
            preg_match_all('/<img.*?src="(.*?)".*?>/is', EndaEditor::MarkDecode($article->content), $result);
            $article->avatar = $result[1];
        }
        $records = Records::where('belong',$id)->limit(50)->get();
        return view('web.other-user.index', compact('user', 'articles','records'));
    }

    public function article($id){
        $articles = Article::where(['user_id' => $id])->paginate(50);
        foreach ($articles as $article) {
            preg_match_all('/<img.*?src="(.*?)".*?>/is', EndaEditor::MarkDecode($article->content), $result);
            $article->avatar = $result[1];
        }
        $user = User::find($id);
        return view('web.other-user.article',compact('articles','user'));
    }
}