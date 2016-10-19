<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 9/30/16
 * Time: 22:08
 */

namespace App\Http\Controllers\Admin;


use Symfony\Component\HttpFoundation\Request;

class AdminController
{
    public function index(Request $request)
    {
        if ($request->user()->isAdmin()) {
            return view('admin.index');
        }
        return view('errors.404');
    }
}