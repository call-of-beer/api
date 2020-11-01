<?php


namespace App\Services;


use App\Events\NewUserHasBeenRegistered;
use App\Mail\WelcomeNewUser;
use App\Models\User;
use App\Services\Interfaces\AuthServicesInterface;
use Illuminate\Support\Facades\Mail;

class AuthServices implements AuthServicesInterface
{
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
}
