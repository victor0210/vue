<?php
namespace App\Http\Controllers\Web\Api;

/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 16/9/18
 * Time: 16:34
 */

use App\Checkers\ThumbChecker;
use App\Http\Controllers\Controller;
use App\Library\Page;
use App\Models\Article;
use App\Repositories\ArticleRepository;
use App\Services\ArticleService;
use App\Services\ThumbService;
use Illuminate\Http\Request;
use YuanChao\Editor\EndaEditor;

class ArticlesController extends Controller
{
    private $articleRepository;
    private $articleService;
    private $thumbService;

    public function __construct(
        ArticleRepository $articleRepository,
        ArticleService $articleService,
        ThumbService $thumbService
    )
    {
        $this->articleRepository = $articleRepository;
        $this->articleService = $articleService;
        $this->thumbService = $thumbService;
    }

    public function index(Request $request)
    {
        $articles = $this->articleService->search($request->val);
        return $articles;
    }

    public function uploadImg()
    {
        $data = EndaEditor::uploadImgFile('path');
        return json_encode($data);
    }

    public function getArticlePage()
    {
        $articles = Article::where('isValidated', true)->paginate(10);
        return $articles;
    }

    public function getArticleList(Request $request)
    {
        $articles = $this->articleRepository->getArticleWithCollectionPageApi($request->status, Page::Ajax_Default_Page_Num);
        return $articles;
    }

    public function thumb(Request $request)
    {
        if (ThumbChecker::isThumb($request->article_id)) {
            return response('Failed', 500);
        }
        $this->thumbService->addThumb($request->article_id);
        return response('Success', 200);
    }
}