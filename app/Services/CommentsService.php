<?php


namespace App\Services;


use App\Models\Comment;
use App\Services\Interfaces\CommentsServiceInterface;
use App\Traits\ResponseDataTrait;

class CommentsService implements CommentsServiceInterface
{
    use ResponseDataTrait;
    public function getCommentOfRating($rating)
    {
        $result = Comment::where('rating_id', $rating)->get();

        return $this->responseWithData($result, 200);
    }

    public function getCommentsOfUser($user)
    {
        $result = Comment::where('user_id', $user)->get();

        return $this->responseWithData($result, 200);
    }

    public function getMyComments()
    {
        $result = Comment::where('user_id', auth()->user()->id)->get();

        return $this->responseWithData($result, 200);
    }

    public function storeComment($rating, $data)
    {
        $comment = new Comment();

        $comment->content = $data->content;
        $comment->user_id = auth()->user()->id;
        $comment->rating_id = $rating->id;

        $comment->save();

        return $this->responseWithData($comment, 200);
    }

    public function deleteComment($comment)
    {
        $comment->delete();

        return $this->responseWithMessage('Comment has been removed', 200);
    }
}
