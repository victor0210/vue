<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2016/10/3
 * Time: 21:57
 */

namespace App\Http\Controllers\Web;

use App\Mail\OrderShipped;
use App\User;
use App\Http\Controllers\Controller;
use Auth;

class MailController extends Controller
{
    public function ship()
    {
        Mail::to(Auth::user())->send(new OrderShipped());
    }
}