<?php
namespace App\Services;

use App\Services\Interfaces\GroupServiceInterface;
use App\Traits\ResponseDataTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupServices implements GroupServiceInterface
{
    use ResponseDataTrait;

    public function getAllGroups()
    {
        $groupAll = Group::with(['tastings', 'users'])->get();

        return $this->responseWithData($groupAll, 200);
    }

    public function getGroupById($group)
    {
        $groupOne = Group::where('id', $group)->get();

        return $this->responseWithData($groupOne, 200);
    }

    public function getAllGroupsWhereUserIsMember()
    {
        $user = auth()->user()->id;
        $group = DB::table('group_user')
            ->where('user_id', $user)
            ->get();

        return $this->responseWithData($group, 200);
    }
}
