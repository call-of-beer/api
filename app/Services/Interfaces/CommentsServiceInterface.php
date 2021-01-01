<?php


namespace App\Services\Interfaces;


interface CommentsServiceInterface
{
    public function getCommentOfTasting($rating);

    public function getMyComments();

    public function storeComment($rating, $data);

    public function deleteComment($comment);

}
