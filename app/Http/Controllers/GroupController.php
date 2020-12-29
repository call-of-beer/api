<?php

namespace App\Http\Controllers;

use App\Services\JoinDeleteUserGroupService;
use App\Services\StoreUpdateDeleteGroupService;
use App\Traits\ResponseDataTrait;
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
    }

    public function store(AddGroupRequest $request)
    {
        if(!$request->validated()) {
            return $this->responseWithError($request);
        }
        else {
            return $this->storeUpdateDeleteGroupService->storeGroup($request);
        }
    }

    public function addUserToGroup(Group $group, AddUserToGroupRequest $request)
    {
        return $this->joinDeleteUserGroupService->joinUserToGroup($group, $request);
    }

    public function destroy(Group $group)
    {
        return $this->storeUpdateDeleteGroupService->deleteGroup($group);
    }

    public function getGroup($groupId)
    {
        return $this->groupServices->getGroupById($groupId);
    }

    public function getAllGroups()
    {
        return $this->groupServices->getAllGroups();
    }

    public function removeUserFromGroup(Group $group, User $user)
    {
        return $this->joinDeleteUserGroupService->removeUserFromGroup($group, $user);
    }

    public function editGroup(Request $request, Group $group)
    {
        return $this->storeUpdateDeleteGroupService->editGroup($group, $request);
    }

    public function getAllGroupsWhereUserIsMember()
    {
        return $this->groupServices->getAllGroupsWhereUserIsMember();
    }
}
