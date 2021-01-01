<?php


namespace App\Services;


use App\Models\Group;
use App\Models\User;
use App\Services\Interfaces\JoinDeleteUserGroupServiceInterface;
use App\Traits\ResponseDataTrait;
use Illuminate\Support\Facades\DB;

class JoinDeleteUserGroupService implements JoinDeleteUserGroupServiceInterface
{
    use ResponseDataTrait;

    public function joinUserToGroup($group, $data)
    {
        $user = User::where('email', $data->email)->first();

        if(DB::table('group_user')
            ->where('moderator_id', $user)
            ->where('group_id', $group)
            ->first())
        {
            return $this->responseWithMessage('User already in group', 400);
        }

        $user->groups()->attach($group->id);

        return $this->responseWithMessage('User has been added to group', 200);
    }

    public function removeUserFromGroup($group, $user)
    {
        $user = User::find($user->id);

        if ($user->can($group->id)) {
            return $this->responseWithMessage('Cannot removed admin of group', 401);
        } else {
            $user->groups()->detach($group->id);
            return $this->responseWithMessage('User has been removed', 200);
        }
    }
}
