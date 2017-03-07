<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 16/9/26
 * Time: 22:33
 */

namespace App\Http\Controllers\Web;


use App\Models\Article;
use App\Http\Controllers\Controller;
use App\Models\Records;
use App\Repositories\ArticleRepository;
use App\Repositories\RecordRepository;
use App\Repositories\UserRepository;
use App\User;
use Auth;
use App\Models\Comment;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $articleRepository;
    private $recordRepository;
    private $userRepository;

    public function __construct(
        ArticleRepository $articleRepository,
        ArticleRepository $articleRepository,
        UserRepository $userRepository
    )
    {
        $this->articleRepository=$articleRepository;
        $this->articleRepository=$articleRepository;
        $this->userRepository=$userRepository;
    }

    public function index()
    {
        $articles = $this->articleRepository->getWithSelf();
        $records = $this->recordRepository->getWithSelf();

        return view('web.user-center', compact('articles', 'records'));
    }

    public function setting()
    {
        return view('web.setting');
    }

    public function setInfo()
    {
        $this->userRepository->updateDescription();
        return redirect('/setting');
    }
}