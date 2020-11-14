<?php
namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Type;

class StoreBeerTypeService
{

    public function store($data)
    {
        $typeOfBeer = new Type;
        $typeOfBeer->name  = $data->name;
        $typeOfBeer->save();

        return response()->json('Type of beer added to database', 200);
    }


}