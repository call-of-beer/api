<?php


namespace App\Services;


use App\Models\Group;
use App\Services\Interfaces\StoreUpdateDeleteGroupServiceInterface;
use App\Traits\ResponseDataTrait;

class StoreUpdateDeleteGroupService implements StoreUpdateDeleteGroupServiceInterface
{
    use ResponseDataTrait;

    public function storeGroup($data)
    {
        $group = new Group();
        $group->name  = $data->name;
        $group->moderator_id = auth()->user()->id;
        auth()->user()->givePermissionTo('admin group');

        $group->save();

        return $this->responseWithData($group, 200);
    }

    public function editGroup($group, $request)
    {
        if(!$group) return $this->responseWithMessage('Data not found', 400);

        $dataValidated = $request->validate([
            'name' => 'string',
            'moderator_id' => 'integer'
        ]);

        $group->update($dataValidated);

        return $this->responseWithMessage('Data updated!', 200);
    }

    public function deleteGroup($group)
    {
        $group->delete();

        return $this->responseWithData('Group has been removed', 200);
    }
}
