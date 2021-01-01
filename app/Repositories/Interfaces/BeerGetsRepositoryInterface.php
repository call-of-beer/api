<?php


namespace App\Repositories\Interfaces;


interface BeerGetsRepositoryInterface
{
    public function getAll();

    public function getAllMy();

    public function getBeer($beer);

    public function getOfType($type);

    public function getOfCountry($country);

    public function getOfTasting($tasting);

}
