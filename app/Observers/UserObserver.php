<?php

namespace App\Observers;

use App\Events\NewUserHasBeenRegistered;
use App\Mail\WelcomeNewUser;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        Mail::to($user->email)->send(new WelcomeNewUser());
    }
}
