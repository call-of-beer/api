<?php


namespace App\Services;


use App\Models\Country;
use App\Repositories\GetCountriesRepository;
use App\Repositories\StoreCountryRepository;
use App\Services\Interfaces\CountryServiceInterface;
use App\Traits\ResponseDataTrait;

class CountryService implements CountryServiceInterface
{
    use ResponseDataTrait;
    private $getcountriesRepository;
    private $storecountryRepository;

    public function __construct(GetCountriesRepository $getcountriesRepository,
    StoreCountryRepository $storecountryRepository)
    {
        $this->getcountriesRepository = $getcountriesRepository;
        $this->storecountryRepository = $storecountryRepository;
    }

    public function getAll()
    {
        $countries = $this->getcountriesRepository->getAll();

        return $this->responseWithData($countries, 200);
    }

    public function getCountry($country)
    {
        $countries = $country
            ? $this->getcountriesRepository->getById($country->id)
            : false;
        return $this->responseWithData($countries, 200);
    }

    public function storeNew($data)
    {
        if (auth()->user()->hasRole('admin'))
        {
            $country = $data
                ? $this->storecountryRepository->addCountry($data)
                : false;
            return $this->responseWithData($country, 200);
        } else {
            return $this->responseWithMessage('Unauthorized', 401);
        }
    }

    public function remove($country)
    {
        if (auth()->user()->hasRole('admin'))
        {
            return $country->delete()
                ? $this->responseWithMessage('Country has been removed', 200)
                : $this->responseWithMessage('Not found', 404);
        } else {
            return $this->responseWithMessage('Unauthorized', 401);
        }
    }
}
