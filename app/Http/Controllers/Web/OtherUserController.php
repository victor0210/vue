<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2016/10/27
 * Time: 10:35
 */

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use App\User;

class OtherUserController extends Controller
{
    public function index($id)
    {
        $user=User::find($id);
        return view('web.other-user.index',compact('user'));
    }
}