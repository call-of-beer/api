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

        $group->save();

        return $this->responseWithData($group, 200);
    }

    public function editGroup($group, $request)
    {
        if (auth()->user()->can($group->id))
        {
            if(!$group) return $this->responseWithMessage('Data not found', 400);

            $dataValidated = $request->validate([
                'name' => 'string',
                'moderator_id' => 'integer'
            ]);

            $group->update($dataValidated);

            return $this->responseWithMessage('Data updated!', 200);
        } else {
            return $this->responseWithMessage('User has no permission', 200);
        }
    }

    public function deleteGroup($group)
    {
        if (auth()->user()->can($group->id))
        {
            $group->delete();

            return $this->responseWithData('Group has been removed', 200);
        } else {
            return $this->responseWithMessage('User has no permission', 200);
        }
    }
}
