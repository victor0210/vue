<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 16/9/27
 * Time: 22:11
 */

namespace App\Http\Controllers\Web;

use App\Models\Article;
use App\Models\Collection;
use App\Models\Comment;
use App\Models\Comment_Replies;
use App\Models\Records;
use App\Models\Thumbs;
use App\Notifications\Comments;
use App\Notifications\Notify;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Request;
use Validator;
use Auth;
use EndaEditor;
use App\Notifications\Articles;

class ArticlesController
{
    function index($id)
    {
        if (!!Article::find($id)) {
            $status = false;
            if (Article::where(['id' => $id, 'isValidated' => true])->get()->isEmpty() && Auth::user()->isAdmin()) {
                Article::find($id)->increment('view');
                $article = Article::find($id);
                $article->content = EndaEditor::MarkDecode($article->content);
                return view('admin.web.article.content', compact('article'));
            } elseif (Article::where(['id' => $id, 'isValidated' => false])->get()->isEmpty()) {
                Article::find($id)->increment('view');
                $user = Article::find($id)->user;
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
                preg_match_all('/<img.*?src="(.*?)".*?>/is', $content->content, $result);
                $comments = Comment::where('article_id', $id)->orderBy('created_at', 'desc')->get();
                foreach ($comments as $comment) {
                    $comment->user_name = User::where('id', $comment->user_id)->value('name');
                    $comment->reply = Comment_Replies::where('comment_id', $comment->id)->get();
                }
                $records = Records::where(['article_id' => $id])->limit(50)->get();
                return view('web.component.article-content.article-content', compact('content', 'comments', 'status', 'user', 'records'));
            } else {
                return view('errors.validating');
            }
        } else {
            return view('errors.404');

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
            User::find(Article::find($id)->user_id)->notify(new Comments($request->user()->name . ' 评论了您的文章 : ' . $request->comment));
            return redirect('/content/' . $id);
        }
    }

    public function add()
    {
        $collections = Collection::orderBy('id','asc')->get();
        return view('web.edit', compact('collections'));
    }

    public function validateArticle(Request $request)
    {
        $admins = User::where('is_admin', '1')->get();
        $rules = ['contents' => 'required', 'title' => 'required|max:30'];
        $messages = ['contents.required' => '请填写内容', 'title.required' => '请填写标题', 'title.max' => '标题最多30个字符'];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput($request->input());
        } else {
            if (Article::insert(
                [
                    'user_id' => Auth::user()->id,
                    'collection' => Collection::where('id', $request['collection'])->value('name'),
                    'title' => $request['title'],
                    'content' => $request['contents'],
                    'created_at' => gmdate('Y-m-d H:i:s'),
                    'updated_at' => gmdate('Y-m-d H:i:s')
                ])
            ) {
                Article::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->first()->searchable();
                foreach ($admins as $admin) {
                    $admin->notify(new Articles(Article::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first()));
                }
                Auth::user()->notify(new Notify('您的文章将' . $request['title'] . '会在第一时间进行审核并给您回复,请耐心等待!'));
                return redirect('/user');
            } else {
                return view('errors.404');
            }
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

    public function search(Request $request)
    {
        $articles = Article::search($request->input('query'))->get();
        foreach ($articles as $article) {
            preg_match_all('/<img.*?src="(.*?)".*?>/is', EndaEditor::MarkDecode($article->content), $result);
            $article->avatar = $result[1];
        }
        $tag = $request->input('query');
        return view('web.result', compact('articles', 'tag'));
    }

    public function ifFiveMinites($timediff)
    {
        return ($timediff->i + ($timediff->h * 60) + ($timediff->d * 1440) + ($timediff->m * 4320) > 5);
    }
}

