<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->middleware(['auth:api']);
    }

    public function index()
    {
        return $this->userService->getAll();
    }

    public function getAdmins()
    {
        return $this->userService->getUsersAdmin();
    }

    public function getDrinkers()
    {
        return $this->userService->getUsersDrinker();
    }

    public function getAuthUser()
    {
        return $this->userService->getUserDetails();
    }

    public function destroy(User $user)
    {
        return $this->userService->destroy($user);
    }
}
