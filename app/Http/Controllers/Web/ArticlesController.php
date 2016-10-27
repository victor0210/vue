<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 16/9/27
 * Time: 22:11
 */

namespace App\Http\Controllers\Web;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Comment_Replies;
use App\Models\Records;
use App\Models\Thumbs;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Request;
use Validator;
use Auth;
use EndaEditor;
use Chromabits\Purifier\Contracts\Purifier;

class ArticlesController
{
    protected $purifier;

    public function __construct(Purifier $purifier)
    {
        $this->purifier = $purifier;
    }

    function index($id)
    {
        $user = Article::find($id)->user;
        Article::find($id)->increment('view');
        $status = false;
        if (Article::where('id', $id)->get()->isEmpty()) {
            return Redirect::back();
        } else {
            if (Auth::check()) {
                if (Records::where(['article_id' => $id, 'user_id' => Auth::user()->id])->get()->isEmpty()) {
                    Records::insert([
                        'user_id' => Auth::user()->id,
                        'article_id' => $id,
                        'belong' => Article::find($id)->user->id,
                        'created_at' => gmdate('Y-m-d H:i:s'),
                        'updated_at' => gmdate('Y-m-d H:i:s')
                    ]);
                } else {
                    Records::where(['article_id' => $id, 'user_id' => Auth::user()->id])->update(['updated_at' => gmdate('Y-m-d H:i:s')]);
                }
                $status = !!Thumbs::where(['article_id' => $id, 'user_id' => Auth::user()->id])->first();
            }

            $content = Article::where('id', $id)->first();
            $content->content = EndaEditor::MarkDecode($content->content);
            $comments = Comment::where('article_id', $id)->orderBy('created_at', 'desc')->get();
            foreach ($comments as $comment) {
                $comment->user_name = User::where('id', $comment->user_id)->value('name');
                $comment->reply = Comment_Replies::where('comment_id', $comment->id)->get();
            }
            $records=Records::where(['article_id'=>$id])->get();
            return view('web.component.article-content.article-content', compact('content', 'comments', 'status', 'user','records'));
        }
    }

    public function postComment(Request $request, $id)
    {
        $rules = ['comment' => 'required|max:100'];
        $messages = ['comment.max' => 'you can most input 100 characters', 'comment.required' => 'comment must be required'];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->with($request->input());
        } else {
            Comment::insert(
                [
                    'content' => $request->comment,
                    'user_id' => Auth::user()->id,
                    'article_id' => $id,
                    'created_at' => gmdate('Y-m-d H:i:s'),
                    'updated_at' => gmdate('Y-m-d H:i:s')
                ]);
            return redirect('/content/' . $id);
        }
    }

    public function add()
    {
        return view('web.edit');
    }

    public function validateArticle(Request $request)
    {
        $rules = ['contents' => 'required', 'title' => 'required'];
        $messages = ['contents.required' => 'content must be required', 'title.required' => 'title must be required'];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->with($request->input());
        } else {
            $request = $this->purifier->clean($request->all());
            Article::insert(
                [
                    'user_id' => Auth::user()->id,
                    'title' => $request['title'],
                    'content' => $request['contents'],
                    'created_at' => gmdate('Y-m-d H:i:s'),
                    'updated_at' => gmdate('Y-m-d H:i:s')
                ]
            );
            return redirect('/user');
        }
    }

    public function reply(Request $request)
    {
        Comment_Replies::insert([
            'comment_id' => $request->comment,
            'sender_id' => Auth::user()->id,
            'receiver_id' => $request->receiver,
            'content' => $request['content'],
            'created_at' => gmdate('Y-m-d H:i:s'),
            'updated_at' => gmdate('Y-m-d H:i:s')
        ]);
        return Redirect::back();
    }
}