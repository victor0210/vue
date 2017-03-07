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

class CommentService
{
    public function deleteQueue($article_id){
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
}