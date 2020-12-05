<?php


namespace App\Services\Interfaces;


use Illuminate\Support\Facades\Auth;

interface GroupServiceInterface
{
    public function getAllGroups();

    public function getGroupById($group);

    public function getAllGroupsWhereUserIsMember();
}
