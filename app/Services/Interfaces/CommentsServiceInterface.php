<?php


namespace App\Services\Interfaces;


interface CommentsServiceInterface
{
    public function getCommentOfRating($rating);

    public function getCommentsOfUser($user);

    public function getMyComments();

    public function storeComment($rating, $data);

    public function deleteComment($comment);

}
