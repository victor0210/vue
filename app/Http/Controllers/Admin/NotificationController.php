<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2016/10/31
 * Time: 22:23
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function newMembers()
    {
        Auth::user()->notifications->where('type', 'App\Notifications\Member')->markAsRead();
        return view('admin.web.notification.new-member');
    }

    public function newArticles()
    {
        Auth::user()->notifications->where('type', 'App\Notifications\Articles')->markAsRead();
        return view('admin.web.notification.new-article');
    }

    public function newFeedback()
    {
        Auth::user()->notifications->where('type', 'App\Notifications\Feedback')->markAsRead();
        return view('admin.web.notification.new-feedback');
    }
}