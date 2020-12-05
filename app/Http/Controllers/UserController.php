<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateUser;
use App\Http\Requests\StoreUser;
use App\Services\UserServices;
use App\Services\ErrorService;
use App\Models\User;

class UserController extends Controller
{
    public function __construct(ErrorService $errorService, UserServices $userService)
    {
        $this->errorService = $errorService;
        $this->userService = $userService;
    }




    public function showAll()
    {
        $user = User::get();
        
        return response()->json(['data' => $user], 201);
        
    }
    
    public function show($id)
    {
        $user = User::where(['id'=>$id])->get();
        
        return response()->json(['data' => $user], 201);
        
    }


    public function store(StoreUser $request)
    {

        if(!$request->validated())
        {
            return $this->errorService->responseWithError($request);
        }
        else
        {
            return $this->userService->store($request);
        }

    }


    public function update(UpdateUser $request, $id)
    {
        $user = User::find($id);

        if($user->id != Auth::user()->id && Auth::user()->hasRole('admin')==false)
        {
            return response()->json(['message' => 'Can not update user'], 401);
        }

        $user->update($request->validated());

        return response()->json($user, 200);
    }


    public function destroy($id)
    {
        $user = User::find($id);

        if($user->id != Auth::user()->id && Auth::user()->hasRole('admin')==false)
        {
            return response()->json(['message' => 'Can not delete user'], 401);
        }

        $user->delete();
        return response()->json('User has been deleted', 200);
    }
}
