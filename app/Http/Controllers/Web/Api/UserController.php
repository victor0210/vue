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
use Illuminate\Http\Request;

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
//        return Comment::find(7)->comment_replies()->get();
////         Article::find($request->id)->comment()->get();
////        Article::find($request->id)->delete();
    }
}