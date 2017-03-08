<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2016/10/27
 * Time: 10:35
 */

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Library\Page;
use App\Library\Record;
use App\Repositories\ArticleRepository;
use App\Services\RecordService;
use App\Services\UserService;
use App\User;

class OtherUserController extends Controller
{
    private $articleRepository;

    private $userSerive;

    private $recordService;

    public function __construct(
        ArticleRepository $articleRepository,
        UserService $userService,
        RecordService $recordService
    )
    {
        $this->articleRepository = $articleRepository;
        $this->userSerive = $userService;
        $this->recordService = $recordService;
    }

    public function index($id)
    {
        if (!!User::find($id)) {
            $user =$this->userSerive->incrementBrowse($id);
            $articles = $this->articleRepository->getArticleWithUserPage($id,Page::Other_User_Page_Num);
            $records = $this->recordService->getWithBelong($id,Record::Other_User_Record_Num);
            return view('web.other-user.index', compact('user', 'articles', 'records'));
        }
        return view('errors.404');
    }

    public function article($id)
    {
        $articles = $this->articleRepository->getArticleWithUserPage($id,Page::Default_Page_Num);
        $user = User::find($id);
        return view('web.other-user.article', compact('articles', 'user'));
    }
}