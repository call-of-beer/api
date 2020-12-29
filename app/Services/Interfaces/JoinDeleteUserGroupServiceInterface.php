<?php


namespace App\Services\Interfaces;


interface JoinDeleteUserGroupServiceInterface
{
    public function joinUserToGroup($group, $data);

    public function removeUserFromGroup($group, $user);
}
