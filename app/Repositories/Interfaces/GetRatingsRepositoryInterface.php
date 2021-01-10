<?php


namespace App\Repositories\Interfaces;


interface GetRatingsRepositoryInterface
{
    public function getAll();

    public function getRatingOfBeer($beer);

    public function getRatingOfUser($user);

    public function getRatingById($rating);

    public function getAvgRatingByTasting($tasting);

}
