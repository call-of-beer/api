<?php


namespace App\Services;


use App\Models\Group;
use App\Repositories\StoreUpdateDeleteGroupRepository;
use App\Services\Interfaces\StoreUpdateDeleteGroupServiceInterface;
use App\Traits\ResponseDataTrait;

class StoreUpdateDeleteGroupService implements StoreUpdateDeleteGroupServiceInterface
{
    use ResponseDataTrait;
    private $storeupdatedeletegroupRepository;

    public function __construct(StoreUpdateDeleteGroupRepository $storeupdatedeletegroupRepository)
    {
        $this->storeupdatedeletegroupRepository = $storeupdatedeletegroupRepository;
    }

    public function storeGroup($data)
    {
        $res = $this->storeupdatedeletegroupRepository->store($data);
        return $res ? $this->responseWithData($res, 200)
            : $this->responseWithMessage('Group has not been stored', 400);
    }

    public function editGroup($group, $data)
    {
        $res = auth()->user()->can($group->id) ?
            $this->storeupdatedeletegroupRepository->edit($group, $data)
            : false;

        return $res ? $this->responseWithData($res, 200)
            : $this->responseWithMessage('User has no permission', 400);
    }

    public function deleteGroup($group)
    {
        $res = auth()->user()->can($group->id) ? $group->delete() : false;
        return $res ? $this->responseWithMessage('Group has been removed', 200)
            : $this->responseWithMessage('User has no permission', 401);
    }
}
