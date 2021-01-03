<?php


namespace App\Repositories;


use App\Models\User;
use App\Repositories\Interfaces\GetsUserRepositoryInterface;

class GetsUserRepository implements GetsUserRepositoryInterface
{
    public function getUsers()
    {
        return User::all()
            ->get();
    }

    public function getUsersAdmin()
    {
        return (new \App\Models\User)->whereHas('roles', function($query) {
            $query->where('roles.name', 'admin');
        })->get();
    }

    public function getUsersDrinker()
    {
        return (new \App\Models\User)->whereHas('roles', function($query) {
            $query->where('roles.name', 'drinker');
        })->get();
    }

    public function getLoggedInUserDetails()
    {
        return User::with('roles')
            ->where('id', '=', auth()->user()->id)
            ->first();
    }
}
