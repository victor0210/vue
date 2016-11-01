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
        return view('admin.web.article.article');
    }

    public function audit()
    {
        $articles=Article::where('isValidated',false)->paginate(10);
        return view('admin.web.article.audit',compact('articles'));
    }
}