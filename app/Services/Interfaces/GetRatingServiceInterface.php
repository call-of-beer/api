<?php


namespace App\Services\Interfaces;


interface GetRatingServiceInterface
{
    public function getAll();

    public function getRatingById($rating);

    public function getRatingOfBeer($beer);

    public function getRatingOfUser($user);

    public function getAverageAroma($beer);
}
