<?php


namespace App\Repositories;


use App\Models\Country;
use App\Repositories\Interfaces\GetsCountriesRepositoryInterface;
use App\Repositories\Interfaces\GetsGroupsRepositoryInterface;

class GetCountriesRepository implements GetsCountriesRepositoryInterface
{
    public function getAll()
    {
        return Country::with('beers')->get();
    }

    public function getCountry($country)
    {
        return Country::with('beers')
            ->where('id', $country->id)
            ->get();
    }
}
