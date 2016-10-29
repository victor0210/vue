<?php
namespace App\Http\Controllers\Web\Api;

/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 16/9/18
 * Time: 16:34
 */

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Thumbs;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use YuanChao\Editor\EndaEditor;

class ArticlesController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::where($request->key, $request->val)->get();
        if ($articles->count() == 0) {
            $articles = Article::limit(10)->get();
        }
        return $articles;
    }

    public function uploadImg()
    {
        $data = EndaEditor::uploadImgFile('path');
        return json_encode($data);
    }

    public function getArticlePage()
    {
        $articles = Article::paginate(10);
        return $articles;
    }

    public function getArticleList(Request $request)
    {
        switch ($request->status) {
            case 'latest':
                $articles = Article::orderBy('created_at', 'desc')->paginate(10);
                foreach ($articles as $article) {
                    preg_match_all('/<img.*?src="(.*?)".*?>/is', EndaEditor::MarkDecode($article->content), $result);
                    $article->avatar = $result[1];
                }
                break;
            case 'hottest':
                $articles = Article::orderBy('view', 'desc')->paginate(10);
                foreach ($articles as $article) {
                    preg_match_all('/<img.*?src="(.*?)".*?>/is', EndaEditor::MarkDecode($article->content), $result);
                    $article->avatar = $result[1];
                }
                break;
        }


        foreach ($articles as $article) {
            $article->user = User::find($article->user_id);
            $article->comment_count = $article->comment->count();
            $article->created = $article->created_at->diffForHumans();
        }
        return $articles;
    }

    public function thumb(Request $request)
    {
        if (!!Thumbs::where(['article_id' => $request->article_id, 'user_id' => Auth::user()->id])->value('created_at')) {
            return response('Failed', 500);
        } else {
            Thumbs::insert([
                'article_id' => $request->article_id,
                'user_id' => Auth::user()->id,
                'created_at' => gmdate('Y-m-d H:i:s'),
                'updated_at' => gmdate('Y-m-d H:i:s')
            ]);
            Article::find($request->article_id)->increment('thumb_up');
            return response('Success', 200);
        }
    }
}