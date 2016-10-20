<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 16/9/17
 * Time: 22:26
 */

namespace App\Http\Controllers\Web;

use App\Models\Article;
use App\Models\Collection;
use App\Models\Comment;
use DB;
use App\Http\Controllers\Controller;
use Mail;
use YuanChao\Editor\EndaEditor;

class IndexController extends Controller
{
    public function index($collection)
    {
        if ($collection != 'all')
            $articles = Article::where(['collection' => $collection])->orderBy('created_at', 'desc')->get();
        else
            $articles = Article::orderBy('created_at', 'desc')->get();

        foreach ($articles as $article) {
            $article->comment_count = Comment::where('article_id', $article->id)->count();
            $article->content = EndaEditor::MarkDecode($article->content);
        }
        return view('web.component.articles.articles', compact('articles'));
    }

    public function collection()
    {
        $collections = Collection::where('is_active',1)->get();
        return view('face-page', compact('collections'));
    }
}
