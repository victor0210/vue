<?php
namespace App\Helper;

use Illuminate\Support\Facades\Storage;
use YuanChao\Editor\EndaEditor;

/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2017/3/6
 * Time: 20:33
 */
class ArticleHelper
{
    /**
     * filename is article->content
     * @param $filename
     * @return string
     */
    public static function format($filename){
        return EndaEditor::MarkDecode(Storage::disk('article')->get($filename));
    }

    /**
     * @param $content
     */
    public static function getImg($content){
        preg_match_all('/<img.*?src="(.*?)".*?>/is', $content, $result);
        return $result[1];
    }

    public static function generateFileNmae(){
        return 'article' . md5(random_int(0, 9999999999999)) . '.md';
    }
}