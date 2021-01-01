<?php


namespace App\Repositories\Interfaces;


interface GetTastingsRepositoryInterface
{
    public function getAllTastings();

    public function getTastingsByGroupId($group);

    public function getTastingById($tasting);
}
