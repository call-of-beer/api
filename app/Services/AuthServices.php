<?php


namespace App\Services;


use App\Events\NewUserHasBeenRegistered;
use App\Mail\WelcomeNewUser;
use App\Models\User;
use App\Services\Interfaces\AuthServicesInterface;
use App\Traits\ResponseDataTrait;
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
        if(!$token = auth()->attempt($data->only('email', 'password'))) {
            return $this->responseJSONToken('Unauthorized', null);
        }

        return $this->responseJSONToken(null, $token);
    }
}
