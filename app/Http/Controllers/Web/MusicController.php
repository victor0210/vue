<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 16/9/27
 * Time: 22:28
 */

namespace App\Http\Controllers\Web;


class MusicController
{
    public function index()
    {
        return view('web.music');
    }
}