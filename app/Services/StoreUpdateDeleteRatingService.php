<?php

namespace App\Services;

use App\Models\Rating;
use App\Services\Interfaces\CreateRatingServiceInterface;
use App\Traits\ResponseDataTrait;

class StoreUpdateDeleteRatingService implements CreateRatingServiceInterface
{
    use ResponseDataTrait;

    public function store($beer, $data)
    {
        $rating = new Rating;
        $rating->aroma = $data->aroma;
        $rating->color = $data->color;
        $rating->taste = $data->taste;
        $rating->bitterness = $data->bitterness;
        $rating->texture = $data->texture;
        $rating->beer_id = $beer->id;
        $rating->user_id = auth()->user()->id;

        if ($rating->save()) {
            return $this->responseWithData($rating, 201);
        } else {
            return $this->responseWithMessage('Sorry, rating could not be added.', 500);
        }
    }

    public function delete($rating)
    {
        $rating->delete();

        return $this->responseWithMessage('Rating has been removed',200);
    }

    public function editRating($rating, $data)
    {
        if (!$rating) {
            return $this->responseWithMessage('Sorry, rating cannot be found.', 400);
        }

        $updated = $rating->update($data->all());

        if ($updated) {
            return $this->responseWithMessage('Data has been updated', 200);
        } else {
            return $this->responseWithMessage('Sorry, data could not be updated.', 500);
        }
    }
}
