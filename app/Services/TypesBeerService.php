<?php


namespace App\Services;


use App\Models\TypeBeer;
use App\Services\Interfaces\TypesBeerServiceInterface;
use App\Traits\ResponseDataTrait;

class TypesBeerService implements TypesBeerServiceInterface
{
    use ResponseDataTrait;
    public function getAll()
    {
        $results = TypeBeer::with('beers')->get();
        return $this->responseWithData($results, 200);
    }

    public function addNew($data)
    {
        $typeBeer = new TypeBeer();
        $typeBeer->name = $data->name;

        $typeBeer->save();
        return $this->responseWithData($typeBeer, 200);
    }

    public function getById($typesBeer)
    {
        $res = TypeBeer::with('beers')
            ->where('id', $typesBeer->id)
            ->get();

        return $this->responseWithData($res, 200);
    }

    public function remove($typesBeer)
    {
        $typesBeer->delete();

        return $this->responseWithMessage('Type of Beer has been removed', 200);
    }
}
