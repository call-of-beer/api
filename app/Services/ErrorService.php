<?php


namespace App\Services;

use App\Services\Interfaces\ErrorServiceInterface;

class ErrorService implements ErrorServiceInterface
{
    public function responseWithError($data)
    {
        return response()->json([
            'status' => 'error',
            'errors' => $data->errors()
        ], 422);
    }
}
