<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2017/3/7
 * Time: 22:11
 */

namespace App\Services;


use App\Checkers\RecordChecker;
use App\Checkers\ThumbChecker;
use App\Helper\ArticleHelper;
use App\Helper\NotifyHelper;
use App\Models\Article;
use App\Models\Collection;
use App\Repositories\ArticleRepository;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class ArticleService
{
    private $articleRepository;

    private $commentService;

    private $recordService;

    private $userService;

    public function __construct(
        ArticleRepository $articleRepository,
        CommentService $commentService,
        RecordService $recordService,
        UserService $userService
    )
    {
        $this->articleRepository = $articleRepository;
        $this->commentService = $commentService;
        $this->recordService = $recordService;
        $this->userService = $userService;
    }

    public function add($title, $collection_id, $filename)
    {
        return !!Article::insert(
            [
                'user_id' => Auth::user()->id,
                'collection' => Collection::find($collection_id)->value('name'),
                'title' => $title,
                'content' => $filename,
                'created_at' => gmdate('Y-m-d H:i:s'),
                'updated_at' => gmdate('Y-m-d H:i:s')
            ]);
    }

    public function deleteQueue($article_id)
    {
        //删除顺序 : 文章二级回复,文章一级回复,文章主体
        $this->commentService->delete($article_id);
        $this->articleRepository->delete($article_id);
        $this->recordService->deleteByArticle($article_id);
    }

    protected function incrementView($id)
    {
        Article::find($id)->increment('view');
    }

    public function adminSee($article_id)
    {
        $this->incrementView($article_id);
        $article = $this->articleRepository->getArticle($article_id);
        return $article;
    }

    public function userSee($article_id)
    {
        $status = false;
        $this->incrementView($article_id);
        if (Auth::check()) {
            if (RecordChecker::isEmpty($article_id)) {
                $this->recordService->add($article_id);
            } else {
                $this->recordService->update($article_id);
            }
            $status = ThumbChecker::isThumb($article_id);
        }
        $user = $this->user($article_id);
        $article = $this->articleRepository->getArticle($article_id);
        $comments = $this->commentService->get($article_id);
        return [$user, $article[0], $comments, $status];
    }

    public function commentSuccess($id)
    {
        $this->commentService->add(Input::get('comment'), $id);

        $notify_user_id = $this->user($id)->id;
        $notify_content = Auth::user()->name . ' 评论了您的文章 : ' . Input::get('comment');
        NotifyHelper::notify($notify_user_id, $notify_content, 'Comment');
    }

    public function save()
    {
        $filename = ArticleHelper::generateFileNmae();
        Storage::disk('article')->put($filename, Input::get('contents'));
        if ($this->add(Input::get('title'), Input::get('collection'), $filename)) {
            $this->addSearchIndex();
            $admins = User::where('is_admin', 1)->get();
            foreach ($admins as $admin) {
                $notify_id = $admin->id;
                $notify_content = Article::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first();
                NotifyHelper::notify($notify_id, $notify_content, 'Article');
            }

            $notify_id = Auth::user()->id;
            $notify_content = '您的文章将' . Input::get('title') . '会在第一时间进行审核并给您回复,请耐心等待!';
            NotifyHelper::notify($notify_id, $notify_content, 'Notify');
            return true;
        }
    }

    public function search($query)
    {
        $articles = Article::search($query)->get();
        foreach ($articles as $article) {
            $article->avatar = ArticleHelper::getImg($article->content);
        }
        return $articles;
    }

    protected function user($id)
    {
        return Article::find($id)->user;
    }

    protected function addSearchIndex()
    {
        Article::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->first()->searchable();
    }
}