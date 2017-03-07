<?php
namespace App\Repositories;

/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2017/3/6
 * Time: 20:16
 */

use App\Models\Article;
use App\Models\Comment;
use Auth;
use Illuminate\Support\Facades\Storage;
use YuanChao\Editor\EndaEditor;

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

    public function getWithSelf()
    {
        $articles = Auth::user()->article()->get();

        return $this->format($articles);
    }

    public function getArticleWithPage($page_num)
    {
        $articles = Article::orderBy('created_at', 'desc')->where(['isValidated' => true])->paginate($page_num);

        return $this->format($articles);
    }

    public function getArticleWithCollectionPage($collection, $page_num)
    {
        $articles = Article::where(['collection' => $collection, 'isValidated' => true])->orderBy('created_at', 'desc')->paginate($page_num);

        return $this->format($articles);
    }

    public function getArticleWithUserPage($user_id, $page_num)
    {
        $articles = Article::where(['user_id' => $user_id, 'isValidated' => true])->paginate($page_num);

        return $this->formatImg($articles);
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

    protected function formatImg($articles)
    {
        foreach ($articles as $article) {
            preg_match_all('/<img.*?src="(.*?)".*?>/is', EndaEditor::MarkDecode($article->content), $result);
            $article->avatar = $result[1];
        }

        return $articles;
    }

    protected function format($articles)
    {
        foreach ($articles as $article) {
            $article->comment_count = Comment::where('article_id', $article->id)->count();
            $article->content = EndaEditor::MarkDecode(Storage::disk('article')->get($article->content));
            preg_match_all('/<img.*?src="(.*?)".*?>/is', EndaEditor::MarkDecode($article->content), $result);
            $article->avatar = $result[1];
        }

        return $articles;
    }

    public function addSearchIndex()
    {
        Article::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->first()->searchable();
    }
}