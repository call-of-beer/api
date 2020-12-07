<?php

namespace App\Observers;

use App\Models\Group;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class GroupObserver
{
    public function created(Group $group)
    {
        $permission = Permission::create([
            'guard_name' => 'api',
            'name' => $group->id]);

        auth()->user()->givePermissionTo($permission);
        $group->users()->attach(auth()->user()->id);
    }
}
