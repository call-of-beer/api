<?php


namespace App\Services;


use App\Models\Beer;
use App\Models\Tasting;
use App\Services\Interfaces\TastingServicesInterfaces;
use App\Traits\ResponseDataTrait;

class TastingServices implements TastingServicesInterfaces
{
    use ResponseDataTrait;
    public function getAll()
    {
        $results = Tasting::with(['user'])->get();

        return $this->responseWithData($results, 200);
    }

    public function store($data, $group)
    {
        $newTasting = new Tasting();

        $newTasting->title = $data->title;
        $newTasting->description = $data->description;
        $newTasting->user_id = auth()->user()->id;
        $newTasting->group_id = $group->id;

        $newTasting->save();

        return $this->responseWithData($newTasting, 200);
    }
}
