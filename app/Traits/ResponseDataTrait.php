<?php

namespace App\Traits;

trait ResponseDataTrait
{
    public function responseJSONToken($error, $token)
    {
        return response()->json([
            'error' => $error,
            'token' => $token
        ], 200);
    }

    public function responseWithError($data)
    {
        return response()->json([
            'status' => 'error',
            'errors' => $data->errors()
        ], 422);
    }

    public function responseWithMessage($data, $status)
    {
        return response()->json([
            'message' => $data
        ], $status);
    }

    public function responseWithData($data, $status)
    {
        return response()->json([
            'result' => $data
        ], $status);
    }
}
