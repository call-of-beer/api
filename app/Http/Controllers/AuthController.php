<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthServices;
use App\Services\ErrorService;

class AuthController extends Controller
{
    private $authServices;
    private $errorService;

    public function __construct(AuthServices $authServices, ErrorService $errorService)
    {
        $this->authServices = $authServices;
        $this->errorService = $errorService;
    }

    public function Login(LoginRequest $request)
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'token' => $token
        ], 200);

    }

    public function Register(RegisterRequest $request)
    {
        if ($request->validated())
        {
            $result = $this->authServices->Register($request);
            return response()->json($result, 200);

        } else {
            return $this->errorService->responseWithError($request);
        }
    }

    public function Logout()
    {
        auth()->logout();
        return response()->json([
            'message' => 'Logout successful'
        ], 200);
    }
}
