<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2016/10/30
 * Time: 14:26
 */

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class NotificationsController extends Controller
{
    public function index()
    {
        Auth::user()->notifications->where('type','App\Notifications\Notify')->markAsRead();
        Auth::user()->notifications->where('type','App\Notifications\Thumb')->markAsRead();
        Auth::user()->notifications->where('type','App\Notifications\Comments')->markAsRead();
        return view('web.notification',compact('notifications'));
    }

    public function delete(Request $request){
        foreach ($request->all() as $id){
            Auth::user()->notifications()->find($id)->delete();
        }
        return Redirect::back();
    }
}