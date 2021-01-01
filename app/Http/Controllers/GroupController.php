<?php

namespace App\Http\Controllers;

use App\Services\JoinDeleteUserGroupService;
use App\Services\StoreUpdateDeleteGroupService;
use App\Traits\ResponseDataTrait;
use Illuminate\Http\Request;
use App\Services\ErrorService;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use App\Models\User;
use App\Http\Requests\AddUserToGroupRequest;
use App\Http\Requests\AddGroupRequest;
use DB;
use App\Services\GroupServices;

class GroupController extends Controller
{
    use ResponseDataTrait;

    private $groupServices;
    private $joinDeleteUserGroupService;
    private $storeUpdateDeleteGroupService;

    public function __construct(
        GroupServices $groupServices,
        JoinDeleteUserGroupService $joinDeleteUserGroupService,
        StoreUpdateDeleteGroupService $storeUpdateDeleteGroupService)
    {
        $this->groupServices = $groupServices;
        $this->joinDeleteUserGroupService = $joinDeleteUserGroupService;
        $this->storeUpdateDeleteGroupService = $storeUpdateDeleteGroupService;
        $this->middleware(['auth:api']);
    }

    public function store(AddGroupRequest $request)
    {
        return $this->storeUpdateDeleteGroupService->storeGroup($request);
    }

    public function addUserToGroup(Group $group, AddUserToGroupRequest $request)
    {
        return \auth()->user()->can($group->id)
            ? $this->joinDeleteUserGroupService->joinUserToGroup($group, $request)
            : $this->responseWithMessage('User has no permission', 401);
    }

    public function destroy(Group $group)
    {
        return $this->storeUpdateDeleteGroupService->deleteGroup($group);
    }

    public function getGroup($groupId)
    {
        return $this->groupServices->getGroupById($groupId);
    }

    public function removeUserFromGroup(Group $group, User $user)
    {
        return \auth()->user()->can($group->id)
            ? $this->joinDeleteUserGroupService->removeUserFromGroup($group, $user)
            : $this->responseWithMessage('User has no permission', 401);
    }

    public function editGroup(Request $request, Group $group)
    {
        return $this->storeUpdateDeleteGroupService->editGroup($group, $request);
    }

    public function getAllMyGroups()
    {
        return $this->groupServices->getAllMyGroups();
    }

    public function getGroupsWhereUserIsMember()
    {
        return $this->groupServices->getGroupsWhereUserIsMember();
    }

    public function getUsersOfGroup(Group $group)
    {
        return $this->groupServices->getUsersOfGroup($group);
    }
}
