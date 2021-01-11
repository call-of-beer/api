<?php


namespace App\Services;


use App\Models\Beer;
use App\Repositories\BeerGetsRepository;
use App\Services\Interfaces\BeerServiceInterface;
use App\Traits\ResponseDataTrait;
use http\Client\Curl\User;

class BeerService implements BeerServiceInterface
{
    use ResponseDataTrait;
    private $beergetsrepository;

    public function __construct(BeerGetsRepository $beerGetsRepository)
    {
        $this->beergetsrepository = $beerGetsRepository;
    }

    public function getAllBeers()
    {
        $res = $this->beergetsrepository->getAll();
        return $res
            ? $this->responseWithData($res, 200)
            : $this->responseWithMessage('Not found', 404);
    }

    public function getAllMyBeers()
    {
        $res = $this->beergetsrepository->getAllMy();
        return $res
            ? $this->responseWithData($res, 200)
            : $this->responseWithMessage('Not found', 404);
    }

    public function getBeerById($beer)
    {
        $res = $this->beergetsrepository->getById($beer->id);
        return $res
            ? $this->responseWithData($res, 200)
            : $this->responseWithMessage('Not found', 404);
    }

    public function getBeerOfType($typeBeer)
    {
        $res = $this->beergetsrepository->getOfType($typeBeer);
        return $res
            ? $this->responseWithData($res, 200)
            : $this->responseWithMessage('Not found', 404);
    }

    public function getBeerOfCountry($country)
    {
        $res = $this->beergetsrepository->getOfCountry($country);
        return $res
            ? $this->responseWithData($res, 200)
            : $this->responseWithMessage('Not found', 404);
    }

    public function getBeerOfTasting($tasting)
    {
        $res = $this->beergetsrepository->getOfTasting($tasting);
        return $res
            ? $this->responseWithData($res, 200)
            : $this->responseWithMessage('Not found', 404);
    }
}
