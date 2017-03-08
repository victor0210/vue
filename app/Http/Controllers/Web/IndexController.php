<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 16/9/17
 * Time: 22:26
 */

namespace App\Http\Controllers\Web;

use App\Library\Page;
use App\Models\Article;
use App\Models\Collection;
use App\Repositories\ArticleRepository;
use App\Services\ArticleService;
use App\Services\CommentService;
use DB;
use App\Http\Controllers\Controller;
use Mail;

class IndexController extends Controller
{
    private $articleRepository;
    private $articleService;

    private $commentService;

    public function __construct(
        ArticleRepository $articleRepository,
        ArticleService $articleService,
        CommentService $commentService
    )
    {
        $this->articleRepository = $articleRepository;
        $this->articleService = $articleService;
        $this->commentService = $commentService;
    }

    public function all()
    {
        $articles = Article::orderBy('created_at', 'desc')->where(['isValidated' => true])->paginate(Page::Face_Page_Num);
        $collections = Collection::orderBy('id', 'asc')->get();
        $page = 'all';

        return view('web.component.articles.articles', compact('articles', 'collections', 'page', 'notifications'));

    }

    public function index($collection)
    {
        if ($this->commentService->getAllNames()->search($collection) >= 0) {
            $articles = $this->articleRepository->getArticleWithCollectionPage($collection, Page::Face_Page_Num);
            $page = $collection;
            $collections = Collection::all();
            return view('web.component.articles.articles', compact('articles', 'collections', 'page', 'notifications'));
        }
        return view('errors.404');

    }

    public function collection()
    {
        $collections = Collection::where('is_active', 1)->orderBy('id', 'asc')->get();
        return view('face-page', compact('collections'));
    }
}
