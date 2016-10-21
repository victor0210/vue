<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2016/10/21
 * Time: 10:26
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles=Article::paginate(25);
        return view('admin.web.article.article',compact('articles'));
    }
}