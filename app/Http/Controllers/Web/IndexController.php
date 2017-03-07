<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 16/9/17
 * Time: 22:26
 */

namespace App\Http\Controllers\Web;

use App\Library\Page;
use App\Models\Collection;
use App\Repositories\ArticleRepository;
use App\Repositories\CollectionRepository;
use DB;
use App\Http\Controllers\Controller;
use Mail;

class IndexController extends Controller
{
    private $articleRepository;

    private $collectionRepository;

    public function __construct(
        ArticleRepository $articleRepository,
        CollectionRepository $collectionRepository
    )
    {
        $this->articleRepository = $articleRepository;
        $this->collectionRepository = $collectionRepository;
    }

    public function all()
    {
        $articles = $this->articleRepository->getArticleFormatPage(Page::Face_Page_Num);
        $collections = Collection::orderBy('id', 'asc')->get();
        $page = 'all';

        return view('web.component.articles.articles', compact('articles', 'collections', 'page', 'notifications'));

    }

    public function index($collection)
    {
        if ($this->collectionRepository->getAllNames()->search($collection)>=0) {
            $articles = $this->articleRepository->getArticleCollectionPage($collection, Page::Face_Page_Num);
            $page = $collection;
            $collections = Collection::all();
            return view('web.component.articles.articles', compact('articles', 'collections', 'page', 'notifications'));
        }
        return view('errors.404');

    }

    public function collection()
    {
        $collections = $this->collectionRepository->getActiveByAsc();
        return view('face-page', compact('collections'));
    }
}
