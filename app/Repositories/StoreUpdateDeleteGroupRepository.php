<?php


namespace App\Repositories;


use App\Models\Group;
use App\Repositories\Interfaces\StoreUpdateDeleteGroupRepositoryInterface;

class StoreUpdateDeleteGroupRepository implements StoreUpdateDeleteGroupRepositoryInterface
{
    public function store($data)
    {
        $group = new Group();
        $group->name = $data->name;

        $group->save();
        return $group;
    }

    public function edit($group, $data)
    {
        if(!$group) return false;
        return $group->update($data) ? $group : false;
    }

    public function remove($group)
    {
        // TODO: Implement remove() method.
    }
}
