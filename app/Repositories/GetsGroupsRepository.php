<?php


namespace App\Repositories;


use App\Models\Group;
use App\Models\User;
use App\Repositories\Interfaces\GetsGroupsRepositoryInterface;
use Illuminate\Support\Facades\DB;

class GetsGroupsRepository implements GetsGroupsRepositoryInterface
{
    public function getAllGroups()
    {
        return Group::with(['tastings', 'users'])->get();
    }

    public function getGroupById($group)
    {
        return Group::with(['tastings', 'users'])
            ->where('id', $group)
            ->get();
    }

    public function getAllMyGroups()
    {
        return Group::with(['tastings', 'users'])
            ->where('moderator_id', \auth()->user()->id)
            ->get();
    }

    public function getGroupsWhereUserIsMember()
    {
        $user = auth()->user();
        return (new \App\Models\Group)->whereHas('users', function($query) use ($user) {
            $query->where('users.id', auth()->user()->id);
        })->get();
    }

    public function getUsersOfGroup($group)
    {
        return (new \App\Models\User)->whereHas('groups', function ($query) use ($group) {
           $query->where('groups.id', $group->id);
        })->get();
    }
}
