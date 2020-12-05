<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddTypeOfBeerRequest;
use App\Services\ErrorService;
use App\Services\TypeServices;
use App\Models\Type;
use App\Models\Beer;



class TypeController extends Controller
{

    public function __construct(ErrorService $errorService, TypeServices $typeServices)
    {
        $this->errorService = $errorService;
        $this->typeServices = $typeServices;
    }


    public function getAll()
    {
        $typesOfBeer = Type::with(['beers'])->get();

        if(!$typesOfBeer) return response()->json(['message' => 'Data not fund!'], 400);
        
        return response()->json([
            'data'=>$typesOfBeer
        ], 200);
    }


    public function getOne($typeOfBeer)
    {
        if(!Type::find($typeOfBeer)) return response()->json(['message' => 'Data not fund!'], 400);

        $type = Type::with(['beers'])->where('id', $typeOfBeer)->get();

        return response()->json([
            'data'=>$type]
            , 200);
    }


    public function store(AddTypeOfBeerRequest $request)
    {
        if(!$request->validated())
        {
            return $this->errorService->responseWithError($request);
        }
        else
        {
            return $this->typeServices->store($request);
        }
    }
    

    public function update(AddTypeOfBeerRequest $request, Type $typeOfBeer)
    {
        
        $data = $request->validate([
            'name' => 'string',
            'description' => 'string'
        ]);

        $typeOfBeer->update($data);

        return response()->json([
            'message'=>'Data updated!'
        ], 200);
    }

    
    public function destroy($id)
    {
        $typeOfBeer = Type::find($id);

        if(!$typeOfBeer) return response()->json(['message' => 'Data not fund!'], 400);

        if(Beer::where('type_id', $id)->first()){
        return response()->json([
            'message'=>'Cant delete data. Used in beer model. Delete or edit beers with this value first.']
            , 400);
        }

        $typeOfBeer->delete();

        return response()->json([
            'message'=>'Data deleted.'
        ], 200);
    }
}
