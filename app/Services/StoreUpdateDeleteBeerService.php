<?php

namespace App\Services;

use App\Models\Beer;
use App\Services\Interfaces\StoreUpdateDeleteBeersInterface;
use App\Traits\ResponseDataTrait;

class StoreUpdateDeleteBeerService implements StoreUpdateDeleteBeersInterface
{
    use ResponseDataTrait;

    public function storeBeer($data, $type_beer, $country)
    {
        $beer = new Beer;
        $beer->name  = $data->name;
        $beer->alcohol_volume = $data->alcohol_volume;
        $beer->country_id = $country->id;
        $beer->description = $data->description;
        $beer->user_id = auth()->user()->id;
        $beer->type_beer_id = $type_beer->id;

        $beer->save();

        return $this->responseWithData('Beer has been added to database', 200);
    }

    public function editBeer($data, $beer)
    {
        if (!$beer) {
            return $this->responseWithMessage('Sorry, beer cannot be found.', 400);
        }

        $updated = $beer->update($data->all());

        if ($updated) {
            return $this->responseWithMessage('Data has been updated', 200);
        } else {
            return $this->responseWithMessage('Sorry, data could not be updated.', 500);
        }
    }

    public function deleteBeer($beer)
    {
        if (!$beer) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, beer with id ' . $beer->id . ' cannot be found.',
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
