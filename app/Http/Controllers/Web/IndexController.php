<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 16/9/17
 * Time: 22:26
 */

namespace App\Http\Controllers\Web;

use App\Models\Article;
use App\Models\Comment;
use DB;
use App\Http\Controllers\Controller;
use Mail;

class IndexController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->get();
        foreach ($articles as $article) {
            $article->comment_count = Comment::where('article_id', $article->id)->count();
        }
        return view('web.component.articles.articles', compact('articles'));
    }
}