<?php
namespace App\Services;

use App\Repositories\GetsGroupsRepository;
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
    private $getsGroupsRepository;

    public function __construct(GetsGroupsRepository $getsGroupsRepository)
    {
        $this->getsGroupsRepository = $getsGroupsRepository;
    }

    public function getAllGroups()
    {
        $res = $this->getsGroupsRepository->getAllGroups();
        return $res ? $this->responseWithData($res, 200)
            : $this->responseWithMessage('Groups base is empty', 404);
    }

    public function getGroupById($group)
    {
        $res = $this->getsGroupsRepository->getGroupById($group);
        return $res ? $this->responseWithData($res, 200)
            : $this->responseWithMessage('Not found', 404);
    }

    public function getAllMyGroups()
    {
        $res = $this->getsGroupsRepository->getAllMyGroups();
        return $res ? $this->responseWithData($res, 200)
            : $this->responseWithMessage('The user does not belong to any group', 404);
    }

    public function getGroupsWhereUserIsMember()
    {
        $res = $this->getsGroupsRepository->getGroupsWhereUserIsMember();
        return $res ? $this->responseWithData($res, 200)
            : $this->responseWithMessage('The user does not belong to any group', 404);
    }
}
