<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StoreRatingService;
use App\Services\ErrorService;
use App\Models\Rating;
use App\Http\Requests\StoreRating;

class RatingController extends Controller
{
    private $storeRatingService;
    private $errorService;

    public function __construct(StoreRatingService $storeRatingService, ErrorService $errorService)
    {
        $this->storeRatingService = $storeRatingService;
        $this->errorService = $errorService;
    }

    public function store(StoreRating $request)
    {
        if($request->validated()) {
            return $this->storeRatingService->store($request);
        } else {
            return $this->errorService->responseWithError($request);
        }
    }

    /**
     * Display a listing of ratings.
     *
     * @return Response
     */
    public function getAll()
    {
        $rating = Rating::get()->toArray();
        return response()->json($rating, 200);
    }

    /**
     * Display rating by id
     *
     * @param  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $rating = Rating::find($id);

        if (!$rating) {
            return response()->json(
                [
                'success' => false,
                'message' => 'Sorry, rating with id ' . $id . ' cannot be found.',
                ], 400
            );
        }

        return response()->json($rating, 200);
    }

    /**
     * Display rating for a specific user
     *
     * @param  $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function userRating($user_id)
    {
        $rating = Rating::where('user_id', $user_id)->get();

        if (!$rating) {
            return response()->json(
                [
                'success' => false,
                'message' => 'Sorry, user did not rate any beers yet.',
                ], 400
            );
        }

        return response()->json($rating, 200);
    }

    /**
     * Display rating for a specific beer
     *
     * @param  $beer_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function beerRating($beer_id)
    {
        $rating = Rating::where('beer_id', $beer_id)->get();

        if (!$rating) {
            return response()->json(
                [
                'success' => false,
                'message' => 'Sorry, beer does not have any ratings.',
                ], 400
            );
        }

        return response()->json($rating, 200);
    }

    /**
     * Update the specified rating.
     *
     * @param  StoreRating $request
     * @param  Rating      $rating
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(StoreRating $request, Rating $rating)
    {
        if (!$rating) {
            return response()->json(
                [
                'success' => false,
                'message' => 'Sorry, rating cannot be found.',
                ], 400
            );
        }

        $updated = $rating->update($request->all());

        if ($updated) {
            return response()->json(
                [
                'success' => true,
                'message' => 'Data has been updated',
                ], 200
            );
        } else {
            return response()->json(
                [
                'success' => false,
                'message' => 'Sorry, data could not be updated.',
                ], 500
            );
        }
    }

    /**
     * Remove the specified rating.
     *
     * @param  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $rating = Rating::find($id);

        if (!$rating) {
            return response()->json(
                [
                'success' => false,
                'message' => 'Sorry, rating with id ' . $id . ' cannot be found.',
                ], 400
            );
        }

        if ($rating->delete()) {
            return response()->json(
                [
                'success' => true,
                'message' => 'Rating was successfully removed',
                ], 200
            );
        } else {
            return response()->json(
                [
                'success' => false,
                'message' => 'Rating could not be deleted.',
                ], 500
            );
        }
    }
}
