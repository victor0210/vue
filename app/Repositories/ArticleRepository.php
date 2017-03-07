<?php
namespace App\Repositories;

/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2017/3/6
 * Time: 20:16
 */

use App\Helper\ArticleHelper;
use App\Helper\NotifyHelper;
use App\Models\Article;
use App\Models\Comment;
use Auth;
use Illuminate\Support\Facades\Storage;
use YuanChao\Editor\EndaEditor;

class ArticleRepository
{
    public function delete($article_id)
    {
        if (Auth::user()->is_admin) {
            $user_id = $this->getUserByArticle($article_id);
            $content = '非常抱歉! 您的文章 << ' . Article::find($article_id)->value('title') . ' >> 已被管理员删除 , 请不要在文章加入任何不良信息 , 谢谢您的合作 !';
            NotifyHelper::notify($user_id, $content, 'Notify');
        }
        Article::find($article_id)->delete();
    }

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

        return $this->formatImg($articles);
    }

    public function getArticleWithCollectionPageApi($collection, $page_num)
    {
        $articles = null;

        switch ($collection) {
            case 'latest':
                $articles = $this->getLatestWithPage($page_num);
                break;
            case 'hottest':
                $articles = $this->getHottestWithPage($page_num);
                break;
            default:
                $articles = $this->getArticleWithCollectionPage($collection, $page_num);
                break;
        }

        return ArticleHelper::formatForApi($articles);
    }

    public function getLatestWithPage($page_num)
    {
        return $this->formatImg($this->getArticleWithPage($page_num));
    }

    public function getHottestWithPage($page_num)
    {
        $articles = Article::where('isValidated', true)->orderBy('view', 'desc')->paginate($page_num);

        return $this->formatImg($articles);
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

    public function getUserIdByArticle($id)
    {
        return Article::find($id)->user_id;
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

    public function formatImg($articles)
    {
        foreach ($articles as $article) {
            preg_match_all('/<img.*?src="(.*?)".*?>/is', EndaEditor::MarkDecode($article->content), $result);
            $article->avatar = $result[1];
        }

        return $articles;
    }

    public function format($articles)
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

    public function searchArticles($query)
    {
        $articles = Article::search($query)->get();
        if ($articles->count() == 0) {
            $articles = Article::get();
        }

        return $articles;
    }

    //admin function
    public function toggleStatus($article_id, $status)
    {
        if (Article::where(['id' => $article_id])->update(['isValidated' => $status]))
            return true;
        return false;
    }
}