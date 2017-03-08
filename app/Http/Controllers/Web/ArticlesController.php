<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 16/9/27
 * Time: 22:11
 */

namespace App\Http\Controllers\Web;

use App\Helper\ValidateHelper;
use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use App\Checkers\ArticleChecker;
use App\Checkers\UserChecker;
use App\Services\CollectionService;
use App\Services\CommentService;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Request;
use Auth;
use EndaEditor;

class ArticlesController extends Controller
{
    private $commentService;

    private $collectionService;

    private $articleService;

    public function __construct(
        CommentService $commentService,
        CollectionService $collectionService,
        ArticleService $articleService
    )
    {
        $this->commentService = $commentService;
        $this->collectionService = $collectionService;
        $this->articleService = $articleService;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id)
    {
        if (ArticleChecker::isExist($id)) {
            if (!ArticleChecker::isValidate($id) && UserChecker::isAdmin()) {
                $article = $this->articleService->adminSee($id);

                return view('admin.web.article.content', compact('article'));
            } elseif (ArticleChecker::isValidate($id)) {
                $arr = $this->articleService->userSee($id);
                $user = $arr[0];
                $article = $arr[1];
                $comments = $arr[2];
                $status = $arr[3];

                return view('web.article-content', compact('article', 'comments', 'status', 'user'));
            }
            return view('errors.validating');
        }
        return view('errors.404');
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
            return ValidateHelper::redirect($validator, $request->all());
        } else {
            $this->articleService->commentSuccess($id);
            return redirect('/content/' . $id);
        }
    }

    public function add()
    {
        $collections = $this->collectionService->getByAsc();

        return view('web.edit', compact('collections'));
    }

    public function validateArticle(Request $request)
    {
        $validator = ValidateHelper::customValidate($request->all(), 'Article');

        if ($validator->fails()) {
            return ValidateHelper::redirect($validator, $request->input());
        }

        if ($this->articleService->save()) {
            return redirect('/user');
        }
        return view('errors.404');
    }

    public function reply(Request $request)
    {
        $this->commentService->addReply($request['comment'], $request['receiver'], $request['content']);
        return Redirect::back();
    }

    public function search()
    {
        $tag = Input::get('query');
        $articles = $this->articleService->search($tag);
        return view('web.result', compact('articles', 'tag'));
    }
}
