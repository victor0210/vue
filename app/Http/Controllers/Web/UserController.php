<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 16/9/26
 * Time: 22:33
 */

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Repositories\ArticleRepository;
use App\Services\ArticleService;
use App\Services\RecordService;
use App\Services\UserService;
use Auth;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    private $articleRepository;
    private $recordService;
    private $userService;

    public function __construct(
        ArticleRepository $articleRepository,
        RecordService $recordService,
        UserService $userService
    )
    {
        $this->articleRepository=$articleRepository;
        $this->recordService=$recordService;
        $this->userService=$userService;
    }

    public function index()
    {
        $articles = Auth::user()->article()->get();
        $records = $this->recordService->getWithSelf();

        return view('web.user-center', compact('articles', 'records'));
    }

    public function setting()
    {
        return view('web.setting');
    }

    public function setInfo()
    {
        $this->userService->updateDescription();
        return redirect('/setting');
    }
}