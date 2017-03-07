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
use App\Repositories\RecordRepository;
use App\Repositories\UserRepository;
use App\User;

class OtherUserController extends Controller
{
    private $articleRepository;

    private $userRepository;

    private $recordRepository;

    public function __construct(
        ArticleRepository $articleRepository,
        UserRepository $userRepository,
        RecordRepository $recordRepository
    )
    {
        $this->articleRepository = $articleRepository;
        $this->userRepository = $userRepository;
        $this->recordRepository = $recordRepository;
    }

    public function index($id)
    {
        if (!!User::find($id)) {
            $user =$this->userRepository->incrementBrowse($id);
            $articles = $this->articleRepository->getArticleWithUserPage($id,Page::Other_User_Page_Num);
            $records = $this->recordRepository->getWithBelong($id,Record::Other_User_Record_Num);
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