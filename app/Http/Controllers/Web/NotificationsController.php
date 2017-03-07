<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2016/10/30
 * Time: 14:26
 */

namespace App\Http\Controllers\Web;


use App\Helper\NotifyHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class NotificationsController extends Controller
{
    public function index()
    {
        NotifyHelper::readNotify();
        return view('web.notification');
    }

    public function delete(Request $request){
        foreach ($request->all() as $id){
            NotifyHelper::delete($id);
        }
        return Redirect::back();
    }
}