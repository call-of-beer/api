<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;
use App\Http\Requests\AddTypeOfBeerRequest;
use App\Services\ErrorService;
use App\Services\StoreBeerTypeService;



class TypeController extends Controller
{

    public function __construct(ErrorService $errorService, StoreBeerTypeService $storeBeerTypeService)
    {
        $this->errorService = $errorService;
        $this->storeBeerTypeService = $storeBeerTypeService;
    }


    public function getAll()
    {
        $typesOfBeer = Type::with(['beers'])->get();
        
        return response ($typesOfBeer, 200);
    }


    public function getOne(Type $typeOfBeer)
    {
        $type = Type::with(['beers'])->whereIn('id', $typeOfBeer)->get();
        
        return response ($type, 200);
    }


    public function store(AddTypeOfBeerRequest $request)
    {
        if(!$request->validated())
        {
            return $this->errorService->responseWithError($request);
        }
        else
        {
            return $this->storeBeerTypeService->store($request);
        }
    }
    

    public function update(AddTypeOfBeerRequest $request, Type $typeOfBeer)
    {
        
        $data = $request->validate([
            'name' => 'string'
        ]);

        $typeOfBeer->update($data);

        return response ("Data updated!", 200);
    }

    public function destroy(Type $typeOfBeer)
    {
        $typeOfBeer->delete();

        //zrobić wyjątek w przypadku, gdy dana wartość jest już użyta w modelu piwa
        //że najpierw trzeba skasować piwo z tą wartością, a dopiero samą wartość

        return response ('Data deleted.', 200);
    }
}
