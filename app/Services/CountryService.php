<?php


namespace App\Services;


use App\Models\Country;
use App\Services\Interfaces\CountryServiceInterface;
use App\Traits\ResponseDataTrait;

class CountryService implements CountryServiceInterface
{
    use ResponseDataTrait;

    public function getAll()
    {
        $countries = Country::with('beers')->get();

        return $this->responseWithData($countries, 200);
    }

    public function storeNew($data)
    {
        $country = new Country();

        $country->name = $data->name;
        $country->shortcut = $data->shortcut;

        $country->save();
        return $this->responseWithData($country, 200);
    }

    public function remove($country)
    {
        $country->delete();
        return $this->responseWithMessage('Country has been removed', 200);
    }
}
