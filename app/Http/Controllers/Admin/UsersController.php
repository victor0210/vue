<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2016/10/31
 * Time: 10:08
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index()
    {
        return view('admin.web.user.user');
    }
}