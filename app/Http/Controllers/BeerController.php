<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StoreBeerService;
use App\Services\ErrorService;
use App\Models\Beer;
use App\Http\Requests\StoreBeer;

class BeerController extends Controller
{
    private $storeBeerService;
    private $errorService;

    public function __construct(StoreBeerService $storeBeerService, ErrorService $errorService)
    {
        $this->storeBeerService = $storeBeerService;
        $this->errorService = $errorService;
    }

    public function store(StoreBeer $request)
    {
        if($request->validated()) {
            return $this->storeBeerService->store($request);
        } else {
            return $this->errorService->responseWithError($request);
        }
    }

    /**
     * Display a listing of beers.
     *
     * @return Response
     */
    public function getAll()
    {
        $beer = Beer::get()->toArray();
        return response()->json($beer, 200);
    }

    /**
     * Display beer by id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
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
        if (!$beer) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, beer cannot be found.',
            ], 400);
        }

        $updated = $beer->update($request->all());

        if ($updated) {
            return response()->json([
                'success' => true,
                'message' => 'Data has been updated',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, data could not be updated.',
            ], 500);
        }
    }

    /**
     * Remove the specified beer.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $beer = Beer::find($id);

        if (!$beer) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, beer with id ' . $id . ' cannot be found.',
            ], 400);
        }

        if ($beer->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Beer was successfully removed',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Beer could not be deleted.',
            ], 500);
        }
    }
}
