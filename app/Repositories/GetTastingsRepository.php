<?php


namespace App\Repositories;


use App\Models\Tasting;
use App\Repositories\Interfaces\GetTastingsRepositoryInterface;

class GetTastingsRepository implements GetTastingsRepositoryInterface
{
    public function getAllTastings()
    {
        return Tasting::with(['user', 'group', 'beer', 'comments'])
            ->get();
    }

    public function getTastingsByGroupId($group)
    {
        return Tasting::with(['user', 'group', 'beer', 'comments'])
            ->where('group_id', $group->id)
            ->get();
    }

    public function getTastingById($tasting)
    {
        return Tasting::with(['user', 'group', 'beer', 'comments'])
            ->where('id', $tasting->id)
            ->get();
    }
}
