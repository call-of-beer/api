<?php


namespace App\Services\Interfaces;


interface UserServiceInterface
{
    public function getAll();

    public function getUsersAdmin();

    public function getUsersDrinker();

    public function getUserDetails();

    public function destroy($user);
}
