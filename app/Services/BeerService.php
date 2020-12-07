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
        $beer = Beer::with(['user', 'ingredients', 'tasteAttributes', 'ratings'])->get();
        return $this->responseWithData($beer, 200);
    }

    public function getAllMyBeers()
    {
        $beer = Beer::where('user_id', auth()->user()->id)->with(['user', 'ingredients', 'tasteAttributes', 'ratings'])->get();
        return $this->responseWithData($beer, 200);
    }

    public function getBeerById($beer)
    {
        $beer = Beer::where('id', $beer)
            ->with(['user', 'ingredients', 'tasteAttributes', 'ratings'])
            ->get();

        if (!$beer) {
            return $this->responseWithMessage('Sorry, beer cannot be found', 404);
        }

        return response()->json($beer, 200);
    }
}
