<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ErrorService;
use App\Services\GroupServices;
use App\Http\Requests\AddUserToGroupRequest;
use App\Http\Requests\AddGroupRequest;
use App\Models\Group;
use App\Models\User;
use DB;

class GroupController extends Controller
{

    public function __construct(ErrorService $errorService, GroupServices $groupServices, User $user, Group $group)
    {
        $this->errorService = $errorService;
        $this->groupServices = $groupServices;
        $this->user = $user;
        $this->group = $group;
    }


    public function getGroup($groupId)
    {
        $groupOne = DB::table('group_user')
        ->where('group_id', $groupId)->get();

        if(!$groupOne){
            return response()->json([
                'message' => "Data not found!",
                'data' => $groupOne,
            ], 400);
        }

        return response()->json([
            'message' => "Data found!",
            'data' => $groupOne,
        ], 200);
    }
    

    public function getAllGroups()
    {
        $groupAll = $this->group->get();
        
        return response()->json([
            'message' => "Data found!",
            'data' => $groupAll,
        ], 200);
    }


    public function getAllGroupsWhereUserIsMember($userId)
    {
        $group = DB::table('group_user')
        ->where('user_id', Auth::user()->id)
        ->get();

        if(!$group){
        return response()->json([
            'message' => "Data not found!",
            'data' => $group,
        ], 400);
        
    
    }
        return response()->json([
            'message' => "Data found!",
            'data' => $group,
        ], 200);
    }


    public function store(AddGroupRequest $request)
    {
        if(!$request->validated())
        {
            return $this->errorService->responseWithError($request);
        }
        else
        {
            return $this->groupServices->store($request);
        }
    }


    public function editGroup(Request $request, $groupid)
    {
        $group = Group::find($groupid);

        if(!$this->groupServices->authorizeUser($group)) return response()->json(['message' => 'Unauthorized'], 401);

        if(!$group) return response()->json(['message'=>'Data not found'], 400);

        $data = $request->validate([
            'name' => 'string',
            'moderator_id' => 'integer'
        ]);

        $group->update($data);

        return response()->json(['message' => "Data updated!"], 200);
        

    }

    public function deleteGroup($groupId)
    {
        $group = Group::find($groupId);

        if(!$this->groupServices->authorizeUser($group)) return response()->json(['message' => 'Unauthorized'], 401);

        DB::table('group_user')->where('group_id', $group->id)->delete();

        $group->delete();

        return response()->json(['message' => "Data deleted!"], 200);

    }

    

    


    public function addUserToGroup(AddUserToGroupRequest $request, $groupId)
    {

        $group = Group::find($groupId);

        if(!$group) return response()->json(['message' => 'Data not fund!'], 400);

        if(!$this->groupServices->authorizeUser($group)) return response()->json(['message' => 'Unauthorized'], 401);

        $user = $this->user->get()->where('email', $request->email)->first();

        if(!$user) return response()->json(['message' => 'User can not be found'], 400);
        
        if(DB::table('group_user')
                ->where('user_id', $user->id)
                ->where('group_id', $groupId)
                ->first())
        {
            return response()->json(['message' => 'User already in group'], 400);
        }

        $user->groups()->attach($groupId);

        return response()->json(['message' => 'User added to group'], 200);

    }


    public function removeUserFromGroup($groupId, $userId)
    {

        $group = Group::find($groupId);

        if(!$group) return response()->json(['message' => 'Data not fund!'], 400);

        if(!$this->groupServices->authorizeUser($group) && Auth::user()->id!=$userId) return response()->json(['message' => 'Unauthorized'], 401);
        //usera z grupy może usunąć moderator grupy, admin, bądź sam user

        $user = User::find($userId);

        if(!$user) return response()->json(['message' => 'User can not be found'], 400);

        if(!DB::table('group_user')
                ->where('user_id', $userId)
                ->where('group_id', $groupId)
                ->first())
        {
            return response()->json(['message' => 'Data incorrect'], 400);
        }

        $user->groups()->detach($group->id);

        return response()->json(['message' => "User removed from group."], 200);

    }

}
