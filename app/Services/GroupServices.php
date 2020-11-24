<?php
namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GroupServices
{

    public function store($data)
    {
        $group = new Group;
        $group->name  = $data->name;
        $group->moderator_id  = Auth::User()->id;
        $group->save();

        $user = Auth::User();

        $user->groups()->attach($group);

        return response()->json([
            'message' =>'Group added to database',
            'data' =>$group], 200);
    }
    
    public function authorizeUser($data){

        $user = Auth::user();

        if($user->id!=$data->moderator_id && $user->hasRole('admin')==false)
        {
            return false;
        }

        return true;

    }


    
}