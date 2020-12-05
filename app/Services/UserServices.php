<?php
namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\AuthorizeUserService;

class UserServices
{

    public function store($data)
    {
        $user = new User;
        $user->firstname = $data->firstname;
        $user->surname = $data->surname;
        $user->email = $data->email;
        $user->password = bcrypt($data->password);

        $user->save();
        
        $user->assignRole($data->role);

        return response()->json($user, 201);

    }

}