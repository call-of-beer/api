<?php


namespace App\Repositories;


use App\Models\Comment;
use App\Repositories\Interfaces\GetsCommentsRepositoryInterface;

class GetsCommentsRepository implements GetsCommentsRepositoryInterface
{
    public function getCommentsOfTasting($tasting)
    {
        $result = Comment::where('tasting_id', $tasting->id)
            ->get();
        return $result;
    }

    public function getMyComments()
    {
        $result = Comment::where('user_id', auth()->user()->id)
            ->get();
        return $result;
    }
}
