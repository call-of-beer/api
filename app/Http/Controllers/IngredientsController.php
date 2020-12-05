<?php

namespace App\Http\Controllers;

use App\Http\Requests\IngredientsRequest;
use App\Models\Beer;
use App\Models\Ingredients;
use App\Services\IngredientsService;
use App\Traits\ResponseDataTrait;
use Illuminate\Http\Request;

class IngredientsController extends Controller
{
    use ResponseDataTrait;
    private $ingredientsService;

    public function __construct(IngredientsService $ingredientsService)
    {
        $this->ingredientsService = $ingredientsService;
    }

    public function index()
    {
        return $this->ingredientsService->getAll();
    }

    public function store(IngredientsRequest $request, Beer $beer)
    {
        return $this->ingredientsService->store($request, $beer);
    }

    public function destroy(Ingredients $ingredient)
    {
        return $this->ingredientsService->destroy($ingredient);
    }


}
