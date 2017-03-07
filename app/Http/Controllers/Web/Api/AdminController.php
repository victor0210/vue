<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2016/10/20
 * Time: 23:55
 */

namespace App\Http\Controllers\Web\Api;


use App\Helper\NotifyHelper;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Repositories\ArticleRepository;
use App\Repositories\CollectionRepository;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $collectionRepository;
    private $articleRepository;

    public function constructor(
        CollectionRepository $collectionRepository,
        ArticleRepository $articleRepository
    )
    {
        $this->middleware('admin');

        $this->collectionRepository = $collectionRepository;
        $this->articleRepository = $articleRepository;
    }

    public function collectionStatus(Request $request)
    {

        if ($this->collectionRepository->toggleStatus($request->id, $request->status))
            return response('Success', 200);
        return response('Failed', 500);
    }

    public function articleStatus(Request $request)
    {
        if ($this->articleRepository->toggleStatus($request->id, $request->status)) {
            $user_id = $this->articleRepository->getUserIdByArticle($request->id);
            $content = '您的文章 << ' . Article::where(['id' => $request->id])->value('title') . ' >> 已通过审核';
            NotifyHelper::notify($user_id, $content, 'Article');
            return response('Success', 200);
        }
        return response('Failed', 500);
    }
}