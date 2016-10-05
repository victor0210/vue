<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 16/9/26
 * Time: 22:33
 */

namespace App\Http\Controllers\Web;


use App\Models\Article;
use App\Http\Controllers\Controller;
use App\Models\Records;
use Auth;
use App\Models\Comment;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $username = $user->name;
        $articles = $user
            ->article()
            ->where('user_id', Auth::user()->id)
            ->get();
        $records = Records::where('user_id', $user->id)->orderBy('created_at','desc')->paginate(10);
        foreach ($articles as $article) {
            $article->comment_count = Comment::where('article_id', $article->id)->count();
        }
        foreach ($records as $record) {
            $record->title = Article::where('id', $record->article_id)->value('title');
        }
        return view('web.user-center', compact('username', 'articles', 'records'));
    }
}