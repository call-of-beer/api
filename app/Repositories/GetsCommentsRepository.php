<?php


namespace App\Repositories;


use App\Models\Comment;
use App\Repositories\Base\BaseRepository;
use App\Repositories\Interfaces\GetsCommentsRepositoryInterface;

class GetsCommentsRepository extends BaseRepository implements GetsCommentsRepositoryInterface
{
    public function getCommentsOfTasting($tasting)
    {
        return Comment::with('user')
            ->where('tasting_id', $tasting->id)
            ->get();
    }

    public function getAllMy()
    {
        return Comment::with('user')
            ->where('user_id', auth()->user()->id)
            ->get();
    }

    public function getAll()
    {
        // TODO: Implement getAll() method.
    }

    public function getById($id)
    {
        // TODO: Implement getById() method.
    }
}
