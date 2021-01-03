<?php

namespace App\Repositories;

use App\Models\Beer;
use App\Repositories\Interfaces\BeerGetsRepositoryInterface;

class BeerGetsRepository implements BeerGetsRepositoryInterface
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

    public function getBeer($beer)
    {
        return Beer::with(['user', 'ratings'])
            ->where('id', $beer->id)
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
            ->where('country_id', $tasting->id)
            ->get();
    }
}
