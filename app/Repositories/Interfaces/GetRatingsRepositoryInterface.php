<?php


namespace App\Repositories\Interfaces;


interface GetRatingsRepositoryInterface
{
    public function getRatingOfBeer($beer);

    public function getRatingOfUser($user);

    public function getAvgRatingByTasting($tasting);
}
