<?php


namespace App\Repositories\Interfaces;


interface GetsGroupsRepositoryInterface
{
    public function getAllGroups();

    public function getGroupById($group);

    public function getAllMyGroups();

    public function getGroupsWhereUserIsMember();
}
