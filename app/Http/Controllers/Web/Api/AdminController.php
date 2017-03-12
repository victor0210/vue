<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2016/10/20
 * Time: 23:55
 */

namespace App\Http\Controllers\Web\Api;


use App\Helper\NotifyHelper;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Collection;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function constructor()
    {
        $this->middleware('admin');
    }

    public function collectionStatus(Request $request)
    {
        if (Collection::where(['id' => $request->id])->update(['is_active' => $request->status]))
            return response('Success', 200);
        return response('Failed', 500);
    }

    public function articleStatus(Request $request)
    {
        if (Article::where(['id' => $request->id])->update(['isValidated' => $request->status])) {
            $user_id = Article::find($request->id)->user_id;
            $content = '您的文章 << ' . Article::where(['id' => $request->id])->value('title') . ' >> 已通过审核';
            NotifyHelper::notify($user_id, $content, 'Article');
            return response('Success', 200);
        }
        return response('Failed', 500);
    }
}