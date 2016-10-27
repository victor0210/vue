<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2016/10/27
 * Time: 10:35
 */

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Records;
use App\User;

class OtherUserController extends Controller
{
    public function index($id)
    {
        $user = User::find($id);
        $articles = Article::where(['user_id' => $id])->limit(10)->get();
        $records = Records::where('belong',$id)->limit(10)->get();
        return view('web.other-user.index', compact('user', 'articles','records'));
    }
}