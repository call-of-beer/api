<?php


namespace App\Services;


use App\Models\Ingredients;
use App\Services\Interfaces\IngredientsServiceInterface;
use App\Traits\ResponseDataTrait;

class IngredientsService implements IngredientsServiceInterface
{
    use ResponseDataTrait;

    public function getAll()
    {
        $result = Ingredients::with('user')->get();

        return $this->responseWithData($result, 200);
    }

    public function store($data, $beer)
    {
        $ingredient = new Ingredients();
        $ingredient->name = $data->name;
        $ingredient->beer_id = $beer->id;

        $ingredient->save();

        return $this->responseWithData($ingredient, 200);
    }

    public function destroy($ingredient)
    {
        $ingredient->delete();

        return $this->responseWithMessage('Ingredient has been deleted', 200);
    }
}
