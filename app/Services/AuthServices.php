<?php


namespace App\Services;


use App\Events\NewUserHasBeenRegistered;
use App\Mail\WelcomeNewUser;
use App\Models\User;
use App\Services\Interfaces\AuthServicesInterface;
use App\Traits\ResponseDataTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthServices implements AuthServicesInterface
{
    use ResponseDataTrait;

    public function Register($data)
    {
        $newUser = new User();
        $newUser->firstname = $data->firstname;
        $newUser->surname = $data->surname;
        $newUser->email = $data->email;
        $newUser->password = bcrypt($data->password);
        $newUser->save();

        return $newUser;
    }

    public function Login($data)
    {
        if (Auth::guard('client')->attempt($data)) {
            $user = Auth::guard('client');
            $token = $user->createToken('api')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }
}
