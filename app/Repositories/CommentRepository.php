<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2017/3/6
 * Time: 21:08
 */

namespace App\Repositories;


use App\Models\Comment;
use App\Models\Comment_Replies;
use App\User;
use Auth;


class CommentRepository
{
    public function getCommentsWithFormat($article_id){
        $comments=Comment::where('article_id', $article_id)->orderBy('created_at', 'desc')->get();
        foreach ($comments as $comment) {
            $comment->user_name = User::where('id', $comment->user_id)->value('name');
            $comment->reply = Comment_Replies::where('comment_id', $comment->id)->get();
        }
        return $comments;
    }

    public function insertComment($content,$article_id){
        Comment::insert(
            [
                'content' => $content,
                'user_id' => Auth::user()->id,
                'article_id' => $article_id,
                'created_at' => gmdate('Y-m-d H:i:s'),
                'updated_at' => gmdate('Y-m-d H:i:s')
            ]);
    }

    public function insertReply($comment_id,$receiver_id,$content){
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