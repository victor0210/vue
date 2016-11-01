<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2016/10/21
 * Time: 13:26
 */

namespace App\Http\Controllers\Web\Api;


use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Records;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function constructor()
    {
        $this->middleware('auth');
    }

    public function index()
    {

    }

    public function deleteRecords(Request $request)
    {
        Records::find($request->id)->delete();
        return 'Success !';
    }

    public function deleteArticles(Request $request)
    {
        if (Auth::user()->id == Article::find($request->id)->user->id || Auth::user()->isAdmin()) {
            $comments = Article::find($request->id)->comment()->get();
            foreach ($comments as $comment) {
                Comment::find($comment->id)->comment_replies()->delete();
            }
            Article::find($request->id)->comment()->delete();
            Article::find($request->id)->delete();
            Records::where('article_id', $request->id)->delete();
            return response('Succeed', 200);
        } else {
            return response('Failed', 500);
        }
    }

    function getUser(Request $request)
    {
        $users = User::search($request->val)->get();
        if ($users->count() == 0) {
            $users = User::get();
        }
        foreach ($users as $user) {
            $user->created_at->timezone('Asia/Chongqing');
        }
        return $users;
    }

    public function getUserPage()
    {
        $users = User::paginate(10);
        foreach ($users as $user) {
            $user->created_at->timezone('Asia/Chongqing');
        }
        return $users;
    }
}