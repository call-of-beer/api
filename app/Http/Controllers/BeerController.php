<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Tasting;
use App\Models\TypeBeer;
use App\Services\BeerService;
use App\Services\joinBeerToTastingService;
use App\Traits\ResponseDataTrait;
use Illuminate\Http\Request;
use App\Services\StoreUpdateDeleteBeerService;
use App\Models\Beer;
use App\Http\Requests\StoreBeer;

class BeerController extends Controller
{
    private $storeBeerService;
    private $beerService;
    private $joinBeerService;
    use ResponseDataTrait;

    public function __construct(
        StoreUpdateDeleteBeerService $storeBeerService,
        BeerService $beerService,
        joinBeerToTastingService $joinBeerService)
    {
        $this->storeBeerService = $storeBeerService;
        $this->beerService = $beerService;
        $this->joinBeerService = $joinBeerService;
    }

    public function store(StoreBeer $request, TypeBeer $type_beer, Country $country)
    {
        return $request->validated() ?
            $this->storeBeerService->storeBeer($request, $type_beer, $country) :
            $this->responseWithError($request);
    }

    public function edit(StoreBeer $request, Beer $beer)
    {
        return $request->validated() ?
            $this->storeBeerService->editBeer($request, $beer) :
            $this->responseWithError($request);
    }

    public function getAll()
    {
        return $this->beerService->getAllBeers();
    }

    public function getMyBeers()
    {
        return $this->beerService->getAllMyBeers();
    }

    public function getBeersOfType(TypeBeer $typeBeer)
    {
        return $this->beerService->getBeerOfType($typeBeer);
    }

    public function getBeersOfCountry(Country $country)
    {
        return $this->beerService->getBeerOfCountry($country);
    }

    public function getBeerOfTasting(Tasting $tasting)
    {
        return $this->beerService->getBeerOfTasting($tasting);
    }

    public function joinBeerToTasting(Beer $beer, Tasting $tasting)
    {
        return $this->joinBeerService->joinBeerToTasting($beer, $tasting);
    }

    public function show(Beer $beer)
    {
        return $this->beerService->getBeerById($beer);
    }

    public function delete(Beer $beer)
    {
        return $this->storeBeerService->deleteBeer($beer);
    }
}
