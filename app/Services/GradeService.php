<?php


namespace App\Services;


use App\Models\Beer;
use App\Models\Grades;
use App\Services\Interfaces\GradesServiceInterface;
use App\Traits\ResponseDataTrait;
use Illuminate\Support\Facades\DB;

class GradeService implements GradesServiceInterface
{
    use ResponseDataTrait;
    public function storeToIngredient($data, $beer, $ingredient)
    {
        if (Beer::where('beer_id', $beer->id)) {
            $grade = new Grades();
            $grade->value = $data->value;
            $grade->title = $data->title;
            $grade->ingredients_id = $ingredient->id;

            $grade->save();
            return $this->responseWithData($grade, 200);
        } else {
            return $this->responseWithMessage('Beer doesnt exist', 404);
        }
    }

    public function storeToRating()
    {
        // TODO: Implement storeToRating() method.
    }

    public function getOverallIngredient($ingredient, $beer)
    {
        if (Beer::where('beer_id', $beer->id)) {

            $getSum = DB::table('grades')
                ->where('ingredients_id', $ingredient->id)
                ->sum('value');

            $getCount = DB::table('grades')
                ->where('ingredients_id', $ingredient->id)
                ->get();

            $getOverall = $getSum / count($getCount);

            return $getOverall;

        } else {
            return false;
        }
    }
}
