<?php

namespace App\Http\Controllers;

use App\Models\Tasting;
use App\Services\BeerService;
use App\Services\joinBeerToTastingService;
use App\Traits\ResponseDataTrait;
use Illuminate\Http\Request;
use App\Services\StoreUpdateDeleteBeerService;
use App\Services\ErrorService;
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

    public function store(StoreBeer $request)
    {
        if($request->validated()) {
            return $this->storeBeerService->storeBeer($request);
        } else {
            return $this->responseWithError($request);
        }
    }

    public function getAll()
    {
        return $this->beerService->getAllBeers();
    }

    public function getMyBeers()
    {
        return $this->beerService->getAllMyBeers();
    }

    public function joinBeerToTasting(Beer $beer, Tasting $tasting)
    {
        return $this->joinBeerService->joinBeerToTasting($beer, $tasting);
    }

    public function show($id)
    {
        $beer = Beer::find($id);

        if (!$beer) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, beer with id ' . $id . ' cannot be found.',
            ], 400);
        }

        return response()->json($beer, 200);
    }

    /**
     * Update the specified beer.
     *
     * @param StoreBeer $request
     * @param Beer $beer
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(StoreBeer $request, Beer $beer)
    {
        return $this->storeBeerService->editBeer($request, $beer);
    }

    /**
     * Remove the specified beer.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Beer $beer)
    {
        return $this->storeBeerService->deleteBeer($beer);
    }
}
