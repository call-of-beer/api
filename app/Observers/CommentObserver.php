<?php

namespace App\Observers;

use App\Models\Comment;

class CommentObserver
{
    public function saving(Comment $comment)
    {
        $comment->user_id = auth()->user()->id;
    }
}
