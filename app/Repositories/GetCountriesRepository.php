<?php


namespace App\Repositories;


use App\Models\Country;
use App\Repositories\Base\BaseRepository;

class GetCountriesRepository extends BaseRepository
{
    public function getAll()
    {
        return Country::with('beers')->get();
    }

    public function getById($id)
    {
        return Country::with('beers')
            ->where('id', $id)
            ->get();
    }

    public function getAllMy()
    {
        // TODO: Implement getAllMy() method.
    }
}
