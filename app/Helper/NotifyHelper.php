<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2017/3/6
 * Time: 21:33
 */

namespace App\Helper;


use App\Notifications\Articles;
use App\Notifications\Comments;
use App\Notifications\Feedback;
use App\Notifications\Member;
use App\Notifications\Notify;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class NotifyHelper
{
    public static function notify($user_id, $content, $type)
    {

        switch ($type) {
            case 'Articles':
                $notify_content = new Articles($content);
                User::find($user_id)->notify($notify_content);
                break;
            case 'Comments':
                $notify_content = new Comments($content);
                User::find($user_id)->notify($notify_content);
                break;
            case 'Member':
                $notify_content = new Member($content);
                User::find($user_id)->notify($notify_content);
                break;
            case 'Notify':
                $notify_content = new Notify($content);
                User::find($user_id)->notify($notify_content);
                break;
            default:
                break;
        }
    }

    public static function feedback(){
        $admins = User::admin();
        foreach ($admins as $admin) {
            $admin->notify(new Feedback(Input::get('feedback'), Auth::user()->name, Auth::user()->id));
        }

        $content = '亲爱的 ' . Auth::user()->name . ',我们已经收到您的反馈,如果是重要问题我们一定会在第一时间进行处理,谢谢!';
        $user = Auth::user();
        $user->notify(new Notify($content));
    }

    public static function readNotify()
    {
        Auth::user()->notifications->where('type', 'App\Notifications\Notify')->markAsRead();
        Auth::user()->notifications->where('type', 'App\Notifications\Thumb')->markAsRead();
        Auth::user()->notifications->where('type', 'App\Notifications\Comments')->markAsRead();
    }

    public static function deleteAll($id_arr)
    {
        foreach ($id_arr as $id){
            Auth::user()->notifications()->find($id)->delete();
        }
    }
}