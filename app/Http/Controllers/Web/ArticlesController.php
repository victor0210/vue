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
    private $ArticleRepository;

    private $UserRepository;

    private $RecordRepository;

    private $ThumbsRepository;

    private $CommentRepository;

    private $CollectionRepository;

    public function __construct(
        ArticleRepository $ArticleRepository,
        UserRepository $UserRepository,
        RecordRepository $RecordRepository,
        ThumbsRepository $ThumbsRepository,
        CommentRepository $CommentRepository,
        CollectionRepository $CollectionRepository
    )
    {
        $this->ArticleRepository = $ArticleRepository;
        $this->UserRepository = $UserRepository;
        $this->RecordRepository= $RecordRepository;
        $this->CommentRepository= $CommentRepository;
        $this->ThumbsRepository= $ThumbsRepository;
        $this->CollectionRepository= $CollectionRepository;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id)
    {
        if ($this->ArticleRepository->exist($id)) {

            $status = false;

            if ($this->ArticleRepository->existWithValidate($id) && $this->UserRepository->isAdmin()) {

                $this->ArticleRepository->incrementView($id);

                $article = $this->ArticleRepository->getArticle($id);

                $article->content = ArticleHelper::format($article->content);

                return view('admin.web.article.content', compact('article'));

            } elseif (!$this->ArticleRepository->existWithValidate($id)) {

                $this->ArticleRepository->incrementView($id);

                $user = $this->ArticleRepository->getUserByArticle($id);

                if (Auth::check()) {

                    if ($this->RecordRepository->isEmptyWithArticle($id)) {

                        $this->RecordRepository->addRecord($id);

                    } else {

                        $this->RecordRepository->updateRecordWithArticle($id);

                    }
                    $status = $this->ThumbsRepository->isThumb($id);
                }

                $article = $this->ArticleRepository->getArticle($id);

                $article->content = ArticleHelper::format($article->content);

                ArticleHelper::getImg($article->content);

                $comments = $this->CommentRepository->getCommentsWithFormat($id);

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
        $validator=ValidateHelper::customValidate($request->all(),'Comment');
        if ($validator->fails()) {
            return $this->redirectBack($validator,$request->all());
        } else {
            $this->CommentRepository->insertComment($request->comment,$id);

            $notify_user_id=$this->ArticleRepository->getUserId($id);
            $notify_content=$request->user()->name . ' 评论了您的文章 : ' . $request->comment;

            NotifyHelper::notify($notify_user_id,$notify_content,'Comment');
            return redirect('/content/' . $id);
        }
    }

    public function add()
    {
        $collections = $this->CollectionRepository->getByAsc();
        return view('web.edit', compact('collections'));
    }

    public function validateArticle(Request $request)
    {
        $admins = $this->UserRepository->admins();

        $validator = ValidateHelper::customValidate($request->all(),'Article');
        if ($validator->fails()) {
            return $this->redirectBack($validator,$request->input());
        } else {
            $filename = ArticleHelper::generateFileNmae();
            Storage::disk('article')->put($filename, $request->contents);

            if ($this->ArticleRepository->addArticle($request['title'],$this->CollectionRepository->getName($request['collection']),$filename)) {
                $this->ArticleRepository->addSearchIndex();
                foreach ($admins as $admin) {
                    $notify_id=$admin->id;
                    $notify_content=Article::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first();
                    NotifyHelper::notify($notify_id,$notify_content,'Article');
                }

                $notify_id=Auth::user()->id;
                $notify_content='您的文章将' . $request['title'] . '会在第一时间进行审核并给您回复,请耐心等待!';
                NotifyHelper::notify($notify_id,$notify_content,'Notify');

                return redirect('/user');
            } else {
                return view('errors.404');
            }
        }
    }

    public function reply(Request $request)
    {
        $this->CommentRepository->insertReply($request['comment'],$request['receiver'],$request['content']);
        return Redirect::back();
    }

    public function search(Request $request)
    {
        $articles = Article::search($request->input('query'))->get();
        foreach ($articles as $article) {
            $article->avatar=ArticleHelper::getImg($article->content);
        }
        $tag = $request->input('query');
        return view('web.result', compact('articles', 'tag'));
    }

    public function ifFiveMinites($timediff)
    {
        return ($timediff->i + ($timediff->h * 60) + ($timediff->d * 1440) + ($timediff->m * 4320) > 5);
    }

    protected function redirectBack($validator,$input){
        return Redirect::back()
            ->withErrors($validator)
            ->with($input);
    }
}

