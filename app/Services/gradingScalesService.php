<?php


namespace App\Services;


use App\Models\GradingScale;
use App\Services\Interfaces\GradingScalesServiceInterface;
use App\Traits\ResponseDataTrait;

class gradingScalesService implements GradingScalesServiceInterface
{
    use ResponseDataTrait;
    public function getAll()
    {
        $results = GradingScale::all();

        return $this->responseWithData($results, 200);
    }

    public function addNew($data)
    {
        $gradingScale = new GradingScale();

        $gradingScale->value = $data->value;
        $gradingScale->title = $data->title;

        $gradingScale->save();

        return $this->responseWithData($gradingScale, 200);
    }

    public function remove($gradingScale)
    {
        $gradingScale->delete();
        return $this->responseWithMessage('Grading Scale has been removed', 200);
    }
}
