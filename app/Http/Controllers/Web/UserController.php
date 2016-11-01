<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 16/9/26
 * Time: 22:33
 */

namespace App\Http\Controllers\Web;


use App\Models\Article;
use App\Http\Controllers\Controller;
use App\Models\Records;
use App\User;
use Auth;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $username = $user->name;
        $articles = $user
            ->article()
            ->where(['user_id'=>Auth::user()->id,'isValidated'=>true])
            ->get();
        $records = Records::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);
        foreach ($articles as $article) {
            $article->comment_count = Comment::where('article_id', $article->id)->count();
        }
        foreach ($records as $record) {
            $record->title = Article::where('id', $record->article_id)->value('title');
        }
        return view('web.user-center', compact('username', 'articles', 'records'));
    }

    public function updateAvatar(Request $request)
    {
        $filename = $request->user()->email . '.png';
        $img = Image::make(file_get_contents(Input::file('avatar')))->resize(200, 200);
        $img->save(storage_path('app/public/avatar/' . $filename));
        if (Storage::disk('avatar')->exists($filename)) {
            $url = asset(Storage::url("public/avatar/" . $filename));
            User::where('id', $request->user()->id)->update(['avatar_url' => $url]);
            return redirect('/setting');
        } else {
            return 'upload failed';
        }
    }

    public function updateBackground(Request $request)
    {
        $filename = $request->user()->email . '.png';
        $img = Image::make(file_get_contents(Input::file('background')));;
        $img->save(storage_path('app/public/background/' . $filename));
        Storage::disk('background')->put($filename, file_get_contents($request->file('background')->getRealPath()));
        if (Storage::disk('background')->exists($filename)) {
            $url = asset(Storage::url("public/background/" . $filename));
            User::where('id', $request->user()->id)->update(['background_url' => $url]);
            return redirect('/setting');
        } else {
            return 'upload failed';
        }
    }

    public function setting()
    {
        return view('web.setting');
    }

    public function setInfo(Request $request)
    {
        User::where('id', $request->user()->id)->update(['description' => $request->description]);
        return redirect('/setting');
    }
}