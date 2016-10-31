<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2016/10/25
 * Time: 00:16
 */

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Notifications\Feedback;
use App\Notifications\Notify;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaticPageController extends Controller
{
    function index()
    {
        return view('web.about');
    }

    function faq()
    {
        return view('web.faq');
    }

    function feedback()
    {
        return view('web.feedback');
    }

    function postFeedBack(Request $request)
    {
        $content = '亲爱的 ' . Auth::user()->name . ',我们已经收到您的反馈,如果是重要问题我们一定会在第一时间进行处理,谢谢!';
        $user = $request->user();
        $admins = User::admin();
        foreach ($admins as $admin) {
            $admin->notify(new Feedback($request->input('feedback'), Auth::user()->name, Auth::user()->id));
        }
        $user->notify(new Notify($content));
        return redirect('/feedback');
    }
}