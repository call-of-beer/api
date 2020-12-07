<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryRequest;
use App\Models\Country;
use App\Services\CountryService;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    private $countryService;

    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    public function index()
    {
        return $this->countryService->getAll();
    }

    public function store(CountryRequest $request)
    {
        return $this->countryService->storeNew($request);
    }

    public function destroy(Country $country)
    {
        return $this->countryService->remove($country);
    }
}
