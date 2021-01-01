<?php


namespace App\Repositories;


use App\Models\Comment;
use App\Repositories\Interfaces\StoreDeleteCommentsRepositoryInterface;

class StoreDeleteStoreDeleteCommentsRepository implements StoreDeleteCommentsRepositoryInterface
{
    public function storeComment($tasting, $data)
    {
        $comment = new Comment();

        $comment->content = $data->content;
        $comment->tasting_id = $tasting->id;
        $comment->save();

        return $comment;
    }

    public function removeComment($tasting)
    {
        // TODO: Implement removeComment() method.
    }
}
