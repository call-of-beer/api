<?php


namespace App\Repositories;


use App\Models\Country;
use App\Repositories\Interfaces\StoreCountryRepositoryInterface;

class StoreCountryRepository implements StoreCountryRepositoryInterface
{
    public function addCountry($data)
    {
        $country = new Country();

        $country->name = $data->name;
        $country->shortcut = $data->shortcut;

        $country->save();

        return $country;
    }
}
