<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 16/9/27
 * Time: 22:11
 */

namespace App\Http\Controllers\Web;

use App\Helper\ArticleHelper;
use App\Helper\NotifyHelper;
use App\Helper\ValidateHelper;
use App\Models\Article;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request;
use Auth;
use EndaEditor;
use App\Repositories\CollectionRepository;
use App\Repositories\ArticleRepository;
use App\Repositories\UserRepository;
use App\Repositories\RecordRepository;
use App\Repositories\ThumbsRepository;
use App\Repositories\CommentRepository;

class ArticlesController
{
    private $articleRepository;

    private $userRepository;

    private $recordRepository;

    private $thumbsRepository;

    private $commentRepository;

    private $collectionRepository;

    public function __construct(
        ArticleRepository $articleRepository,
        UserRepository $userRepository,
        RecordRepository $recordRepository,
        ThumbsRepository $thumbsRepository,
        CommentRepository $commentRepository,
        CollectionRepository $collectionRepository
    )
    {
        $this->articleRepository = $articleRepository;
        $this->userRepository = $userRepository;
        $this->recordRepository = $recordRepository;
        $this->commentRepository = $commentRepository;
        $this->thumbsRepository = $thumbsRepository;
        $this->collectionRepository = $collectionRepository;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id)
    {
        if ($this->articleRepository->exist($id)) {

            $status = false;    // flag 'is_thumb'

            if ($this->articleRepository->existWithValidate($id) && $this->userRepository->isAdmin()) {
                $this->articleRepository->incrementView($id);

                $article = $this->articleRepository->getArticle($id);

                $article->content = ArticleHelper::format($article->content);
                return view('admin.web.article.content', compact('article'));
            } elseif (!$this->articleRepository->existWithValidate($id)) {
                $this->articleRepository->incrementView($id);

                $user = $this->articleRepository->getUserByArticle($id);

                if (Auth::check()) {
                    if ($this->recordRepository->isEmptyWithArticle($id)) {
                        $this->recordRepository->addRecord($id);
                    } else {
                        $this->recordRepository->updateRecordWithArticle($id);
                    }

                    $status = $this->thumbsRepository->isThumb($id);

                }
                $article = $this->articleRepository->getArticle($id);
                $article->content = ArticleHelper::format($article->content);
                ArticleHelper::getImg($article->content);

                $comments = $this->commentRepository->getCommentsWithFormat($id);

                return view('web.article-content', compact('article', 'comments', 'status', 'user'));
            } else {
                return view('errors.validating');
            }
        } else {
            return view('errors.404');
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return Redirect
     */
    public function postComment(Request $request, $id)
    {
        $validator = ValidateHelper::customValidate($request->all(), 'Comment');

        if ($validator->fails()) {
            return $this->redirectBack($validator, $request->all());
        } else {
            $this->commentRepository->insertComment($request->comment, $id);

            $notify_user_id = $this->articleRepository->getUserId($id);
            $notify_content = $request->user()->name . ' 评论了您的文章 : ' . $request->comment;

            NotifyHelper::notify($notify_user_id, $notify_content, 'Comment');
            return redirect('/content/' . $id);
        }
    }

    public function add()
    {
        $collections = $this->collectionRepository->getByAsc();

        return view('web.edit', compact('collections'));
    }

    public function validateArticle(Request $request)
    {
        $admins = $this->userRepository->admins();
        $validator = ValidateHelper::customValidate($request->all(), 'Article');

        if ($validator->fails()) {
            return $this->redirectBack($validator, $request->input());
        } else {
            $filename = ArticleHelper::generateFileNmae();

            Storage::disk('article')->put($filename, $request->contents);
            if ($this->articleRepository->addArticle($request['title'], $this->collectionRepository->getName($request['collection']), $filename)) {
                $this->articleRepository->addSearchIndex();
                foreach ($admins as $admin) {

                    $notify_id = $admin->id;
                    $notify_content = Article::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first();

                    NotifyHelper::notify($notify_id, $notify_content, 'Article');
                }

                $notify_id = Auth::user()->id;
                $notify_content = '您的文章将' . $request['title'] . '会在第一时间进行审核并给您回复,请耐心等待!';

                NotifyHelper::notify($notify_id, $notify_content, 'Notify');
                return redirect('/user');
            } else {
                return view('errors.404');
            }
        }
    }

    public function reply(Request $request)
    {
        $this->commentRepository->insertReply($request['comment'], $request['receiver'], $request['content']);
        return Redirect::back();
    }

    public function search(Request $request)
    {
        $articles = Article::search($request->input('query'))->get();
        $tag = $request->input('query');

        foreach ($articles as $article) {
            $article->avatar = ArticleHelper::getImg($article->content);
        }

        return view('web.result', compact('articles', 'tag'));
    }

    public function ifFiveMinites($timediff)
    {
        return ($timediff->i + ($timediff->h * 60) + ($timediff->d * 1440) + ($timediff->m * 4320) > 5);
    }

    protected function redirectBack($validator, $input)
    {
        return Redirect::back()
            ->withErrors($validator)
            ->with($input);
    }
}
