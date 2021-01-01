<?php


namespace App\Repositories;


use App\Models\Beer;
use App\Repositories\Interfaces\BeerGetsRepositoryInterface;

class BeerGetsRepository implements BeerGetsRepositoryInterface
{
    public function getAll()
    {
        $beers = Beer::with(['user', 'ratings'])->get();
        return $beers;
    }

    public function getAllMy()
    {
        $beers = Beer::where('user_id', auth()->user()->id)->with(['user', 'ratings'])->get();
        return $beers;
    }

    public function getBeer($beer)
    {
        $beer = Beer::where('id', $beer->id)
            ->with(['user', 'ratings'])
            ->get();

        return $beer;
    }

    public function getOfType($type)
    {
        $beer = Beer::where('type_beer_id', $type->id)
            ->with(['user', 'ratings'])
            ->get();

        return $beer;
    }

    public function getOfCountry($country)
    {
        $beer = Beer::where('country_id', $country->id)
            ->with(['user', 'ratings'])
            ->get();

        return $beer;
    }

    public function getOfTasting($tasting)
    {
        $beer = Beer::where('country_id', $tasting->id)
            ->with(['user', 'ratings'])
            ->get();

        return $beer;
    }
}
