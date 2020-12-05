<?php

namespace App\Services;

use App\Models\Beer;

class StoreBeerService
{
    /**
     * Store a newly created beer.
     *
     * @param  $data
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store($data)
    {
        $beer = new Beer;
        $beer->name  = $data->name;
        $beer->alcohol_volume = $data->alcohol_volume;
        $beer->country = $data->country;
        $beer->description = $data->description;
        $beer->type_id = $data->type_id;

        if ($beer->save()) {
            return response()->json(
                [
                'success' => true,
                'message' => 'Beer has been added to database.'
                ], 201
            );
        } else {
            return response()->json(
                [
                'success' => false,
                'message' => 'Sorry, beer could not be added.',
                ], 500
            );
        }
    }


} 