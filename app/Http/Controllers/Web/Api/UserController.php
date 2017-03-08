<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2016/10/21
 * Time: 13:26
 */

namespace App\Http\Controllers\Web\Api;


use App\Http\Controllers\Controller;
use App\Checkers\UserChecker;
use App\Library\Page;
use App\Models\Records;
use App\Services\ArticleService;
use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $articleService;

    private $userService;

    function __construct(
        UserService $userService,
        ArticleService $articleService
    )
    {
        $this->middleware('auth');

        $this->userService = $userService;
        $this->articleService= $articleService;
    }

    public function deleteRecords(Request $request)
    {
        Records::find($request->id)->delete();
        return 'Success !';
    }

    public function deleteArticles(Request $request)
    {
        if (UserChecker::ifCanDelete($request->id)) {
            $this->articleService->deleteQueue($request->id);
            return response('Succeed', 200);
        }
        return response('Failed', 500);
    }

    function getUser(Request $request)
    {
        return $this->userService->timezoneFormat($this->userService->search($request->val));
    }

    public function getUserPage()
    {
        return $this->userService->timezoneFormat(User::paginate(Page::Ajax_Default_Page_Num));
    }
}