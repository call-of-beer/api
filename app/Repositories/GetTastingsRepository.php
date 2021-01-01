<?php


namespace App\Repositories;


use App\Models\Tasting;
use App\Repositories\Interfaces\GetTastingsRepositoryInterface;

class GetTastingsRepository implements GetTastingsRepositoryInterface
{
    public function getAllTastings()
    {
        $results = Tasting::with(['user', 'group', 'beer', 'comments'])->get();
        return $results;
    }

    public function getTastingsByGroupId($group)
    {
        $results = Tasting::with(['user', 'group', 'beer', 'comments'])
            ->where('group_id', $group->id)
            ->get();

        return $results;
    }

    public function getTastingById($tasting)
    {
        $results = Tasting::with(['user', 'group', 'beer', 'comments'])
            ->where('id', $tasting->id)
            ->get();

        return $results;
    }
}
