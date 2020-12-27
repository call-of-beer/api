<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthServices;
use App\Services\ErrorService;
use App\Traits\ResponseDataTrait;

class AuthController extends Controller
{
    use ResponseDataTrait;
    private $authServices;

    public function __construct(AuthServices $authServices)
    {
        $this->authServices = $authServices;
    }

    public function Login(LoginRequest $request)
    {
        return $request->validated() ? $this->authServices->Login($request)
            : $this->responseWithMessage('Error', 401);

    }

    public function Register(RegisterRequest $request)
    {
        if ($request->validated())
        {
            $result = $this->authServices->Register($request);
            return response()->json($result, 200);

        } else {
            return $this->responseWithError($request);
        }
    }

    public function Logout()
    {
        auth()->logout();
        return $this->responseWithMessage('Logout successful', 200);
    }
}
