<?php


namespace App\Repositories\Interfaces;


interface GetsUserRepositoryInterface
{
    public function getUsers();

    public function getUsersAdmin();

    public function getUsersDrinker();

    public function getLoggedInUserDetails();
}
