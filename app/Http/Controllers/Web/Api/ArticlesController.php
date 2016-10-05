<?php
namespace App\Http\Controllers\Web\Api;

/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 16/9/18
 * Time: 16:34
 */

use App\Models\Article;
use Validator;

class ArticlesController
{
    public function index(){
        $resp=Article::get();
        dd($resp);
    }
}