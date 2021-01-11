<?php

namespace App\Repositories;

use App\Models\Beer;
use App\Repositories\Base\BaseRepository;
use App\Repositories\Interfaces\BeerGetsRepositoryInterface;

class BeerGetsRepository extends BaseRepository implements BeerGetsRepositoryInterface
{
    public function getAll()
    {
        return Beer::with(['user', 'ratings'])
            ->get();
    }

    public function getAllMy()
    {
        return Beer::with(['user', 'ratings'])
            ->where('user_id', auth()->user()->id)
            ->get();
    }

    public function getById($id)
    {
        return Beer::with(['user', 'ratings'])
            ->where('id', $id)
            ->get();
    }

    public function getOfType($type)
    {
        return Beer::with(['user', 'ratings'])
            ->where('type_beer_id', $type->id)
            ->get();
    }

    public function getOfCountry($country)
    {
        return Beer::with(['user', 'ratings'])
            ->where('country_id', $country->id)
            ->get();
    }

    public function getOfTasting($tasting)
    {
        return Beer::with(['user', 'ratings'])
            ->where('tasting_id', $tasting->id)
            ->get();
    }
}
