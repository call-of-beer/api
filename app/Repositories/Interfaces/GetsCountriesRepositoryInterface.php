<?php


namespace App\Repositories\Interfaces;


interface GetsCountriesRepositoryInterface
{
    public function getAll();

    public function getCountry($country);
}
