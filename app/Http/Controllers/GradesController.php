<?php

namespace App\Http\Controllers;

use App\Http\Requests\GradesRequest;
use App\Models\Beer;
use App\Models\Grades;
use App\Models\Ingredients;
use App\Services\GradeService;
use App\Traits\ResponseDataTrait;
use Illuminate\Http\Request;

class GradesController extends Controller
{
    use ResponseDataTrait;
    private $gradesService;

    public function __construct(GradeService $gradeService)
    {
        $this->gradesService = $gradeService;
    }

    public function storeToIngredient(GradesRequest $request, Ingredients $ingredient, Beer $beer)
    {
        return $this->gradesService->storeToIngredient($request, $beer, $ingredient);
    }

    public function getOverallIngredients(Ingredients $ingredients, Beer $beer)
    {
        return $this->gradesService->getOverallIngredient($ingredients, $beer);
    }
}
