<?php


namespace App\Services;


use App\Models\Beer;
use App\Services\Interfaces\BeerServiceInterface;
use App\Traits\ResponseDataTrait;

class BeerService implements BeerServiceInterface
{
    use ResponseDataTrait;
    public function getAllBeers()
    {
        $beer = Beer::with(['user', 'ingredients'])->get();
        return $this->responseWithData($beer, 200);
    }

    public function getAllMyBeers()
    {
        $beer = Beer::where('user_id', auth()->user()->id)->with(['user', 'ingredients'])->get();
        return $this->responseWithData($beer, 200);
    }
}
