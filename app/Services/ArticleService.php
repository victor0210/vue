<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2017/3/7
 * Time: 22:11
 */

namespace App\Services;


use App\Helper\NotifyHelper;
use App\Models\Article;
use App\Repositories\ArticleRepository;
use Illuminate\Support\Facades\Auth;

class ArticleService
{
    private $commentService;

    private $articleRepository;

    private $recordService;

    public function __construct(
        ArticleRepository $articleRepository,
        CommentService $commentService,
        RecordService $recordService
    )
    {
        $this->articleRepository = $articleRepository;
        $this->commentService = $commentService;
        $this->recordService = $recordService;
    }

    public function delete($article_id)
    {
        //删除顺序 : 文章二级回复,文章一级回复,文章主体
        $this->commentService->delete($article_id);
        $this->articleRepository->delete($article_id);
        $this->recordService->deleteByArticle($article_id);

    }

    public function canDelete($article_id)
    {
        return (Auth::user()->id == Article::find($article_id)->user->id) || (Auth::user()->is_admin == 1);
    }
}