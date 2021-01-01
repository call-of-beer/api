<?php


namespace App\Repositories;


use App\Models\Tasting;
use App\Repositories\Interfaces\StoreTastingRepositoryInterface;

class StoreTastingRepository implements StoreTastingRepositoryInterface
{
    public function store($data, $group, $beer)
    {
        $newTasting = new Tasting();

        $newTasting->title = $data->title;
        $newTasting->description = $data->description;
        $newTasting->user_id = auth()->user()->id;
        $newTasting->group_id = $group->id;
        $newTasting->beer_id = $beer->id;

        $newTasting->save();

        return $newTasting;
    }
}
