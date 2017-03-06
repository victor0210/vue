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
use App\Notifications\Member;
use App\Notifications\Notify;
use App\User;

class NotifyHelper
{
    public static function notify($user_id,$content,$type){

        switch ($type){
            case 'Articles':
                $notify_content=new Articles($content);
                User::find($user_id)->notify($notify_content);
                break;
            case 'Comments':
                $notify_content=new Comments($content);
                User::find($user_id)->notify($notify_content);
                break;
            case 'Member':
                $notify_content=new Member($content);
                User::find($user_id)->notify($notify_content);
                break;
            case 'Notify':
                $notify_content=new Notify($content);
                User::find($user_id)->notify($notify_content);
                break;
            default:
                break;
        }
    }
}