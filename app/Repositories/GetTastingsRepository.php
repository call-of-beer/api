<?php


namespace App\Repositories;


use App\Models\Tasting;
use App\Repositories\Interfaces\GetTastingsRepositoryInterface;

class GetTastingsRepository implements GetTastingsRepositoryInterface
{
    public function getAllTastings()
    {
        $results = Tasting::with(['user', 'group', 'beer'])->get();
        return $results;
    }

    public function getTastingsByGroupId($group)
    {
        $results = Tasting::with(['user', 'group', 'beer'])
            ->where('group_id', $group->id)
            ->get();

        return $results;
    }

    public function getTastingById($tasting)
    {
        $results = Tasting::with(['user', 'group', 'beer'])
            ->where('id', $tasting->id)
            ->get();

        return $results;
    }
}
