<?php


namespace App\Repositories\Interfaces;


interface BeerGetsRepositoryInterface
{
    public function getOfType($type);

    public function getOfCountry($country);

    public function getOfTasting($tasting);
}
