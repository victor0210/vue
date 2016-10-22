<?php
namespace App\Http\Controllers\Web\Api;

/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 16/9/18
 * Time: 16:34
 */

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use YuanChao\Editor\EndaEditor;

class ArticlesController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::where($request->key, $request->val)->get();
        if ($request->val=='all') {
            $articles=Article::get();
        }
        return $articles;
    }

    public function uploadImg()
    {
        $data = EndaEditor::uploadImgFile('path');
        return json_encode($data);
    }
}