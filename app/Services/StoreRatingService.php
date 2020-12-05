<?php

namespace App\Services;

use App\Models\Rating;
use App\Traits\ResponseDataTrait;

class StoreRatingService
{
    use ResponseDataTrait;
    /**
     * Store a newly created rating.
     *
     * @param  $data
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store($data)
    {
        $rating = new Rating;
        $rating->aroma  = $data->aroma;
        $rating->color = $data->color;
        $rating->taste = $data->taste;
        $rating->bitterness = $data->bitterness;
        $rating->texture = $data->texture;
        $rating->overall = $data->overall;
        $rating->comment = $data->comment;
        $rating->beer_id = $data->beer_id;
        $rating->user_id = $data->user_id;

        if ($rating->save()) {
            $this->responseWithMessage('Rating has been added to database.', 201);
        } else {
            $this->responseWithMessage('Sorry, rating could not be added.', 500);
        }
    }


}
