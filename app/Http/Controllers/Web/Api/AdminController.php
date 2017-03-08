<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2016/10/20
 * Time: 23:55
 */

namespace App\Http\Controllers\Web\Api;


use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use App\Services\CollectionService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $collectionService;
    private $articleService;

    public function constructor(
        CollectionService $collectionService,
        ArticleService $articleService
    )
    {
        $this->middleware('admin');

        $this->collectionService = $collectionService;
        $this->articleService = $articleService;
    }

    public function collectionStatus(Request $request)
    {
        if ($this->collectionService->toggleStatus($request->id, $request->status))
            return response('Success', 200);
        return response('Failed', 500);
    }

    public function articleStatus(Request $request)
    {
        if ($this->articleService->toggleStatus($request)) {
            return response('Success', 200);
        }
        return response('Failed', 500);
    }
}