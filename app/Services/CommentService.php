<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2017/3/7
 * Time: 22:17
 */

namespace App\Services;


use App\Models\Article;
use App\Models\Comment;
use App\Models\Comment_Replies;
use App\User;
use Illuminate\Support\Facades\Auth;

class CommentService
{
    public function delete($article_id){
        $comments = Article::find($article_id)->comment()->get();
        $this->deleteReplies($comments);
        $this->deleteComment($article_id);

    }
    protected function deleteComment($article_id){
        Article::find($article_id)->comment()->delete();
    }

    protected function deleteReplies($comments){
        foreach ($comments as $comment) {
            Comment::find($comment->id)->comment_replies()->delete();
        }
    }

    public function get($article_id){
        $comments=Comment::where('article_id', $article_id)->orderBy('created_at', 'desc')->get();
        foreach ($comments as $comment) {
            $comment->user_name = User::where('id', $comment->user_id)->value('name');
            $comment->reply = Comment_Replies::where('comment_id', $comment->id)->get();
        }
        return $comments;
    }

    public function add($content,$article_id){
        Comment::insert(
            [
                'content' => $content,
                'user_id' => Auth::user()->id,
                'article_id' => $article_id,
                'created_at' => gmdate('Y-m-d H:i:s'),
                'updated_at' => gmdate('Y-m-d H:i:s')
            ]);
    }

    public function addReply($comment_id,$receiver_id,$content){
        Comment_Replies::insert([
            'comment_id' => $comment_id,
            'sender_id' => Auth::user()->id,
            'receiver_id' => $receiver_id,
            'content' => $content,
            'created_at' => gmdate('Y-m-d H:i:s'),
            'updated_at' => gmdate('Y-m-d H:i:s')
        ]);
    }
}