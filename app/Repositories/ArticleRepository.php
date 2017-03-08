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
            $user_id = Article::find($article_id)->user_id;
            $content = '非常抱歉! 您的文章 << ' . Article::find($article_id)->value('title') . ' >> 已被管理员删除 , 请不要在文章加入任何不良信息 , 谢谢您的合作 !';
            NotifyHelper::notify($user_id, $content, 'Notify');
        }
        Article::find($article_id)->delete();
    }

    public function getArticle($id)
    {
        $article = Article::find($id);

        return $this->format([$article]);
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
        $articles= $this->getArticleWithPage($page_num);

        return $this->format($articles);
    }

    public function getHottestWithPage($page_num)
    {
        $articles = Article::where('isValidated', true)->orderBy('view', 'desc')->paginate($page_num);

        return $this->format($articles);
    }

    public function getArticleWithUserPage($user_id, $page_num)
    {
        $articles = Article::where(['user_id' => $user_id, 'isValidated' => true])->paginate($page_num);

        return $this->format($articles);
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
}