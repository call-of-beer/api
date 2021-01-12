<?php


namespace App\Services;


use App\Repositories\GetsUserRepository;
use App\Services\Interfaces\UserServiceInterface;
use App\Traits\ResponseDataTrait;

class UserService implements UserServiceInterface
{
    use ResponseDataTrait;
    private $getUserRepository;

    public function __construct(GetsUserRepository $getUserRepository)
    {
        $this->getUserRepository = $getUserRepository;
    }

    public function getAll()
    {
        $res = $this->getUserRepository->getUsers();
        return $res
            ? $this->responseWithData($res, 200)
            : $this->responseWithMessage('Users table is empty', 404);
    }

    public function getUsersAdmin()
    {
        $res = $this->getUserRepository->getUsersAdmin();
        return $res
            ? $this->responseWithData($res, 200)
            : $this->responseWithMessage('Users admin table is empty', 404);
    }

    public function getUsersDrinker()
    {
        $res = $this->getUserRepository->getUsersDrinker();
        return $res
            ? $this->responseWithData($res, 200)
            : $this->responseWithMessage('Users drinker table is empty', 404);
    }

    public function getUserDetails()
    {
        $res = $this->getUserRepository->getLoggedInUserDetails();
        return $res
            ? $this->responseWithData($res, 200)
            : $this->responseWithMessage('Not found', 404);
    }

    public function destroy($user)
    {

        if($user->id != Auth::user()->id && Auth::user()->hasRole('admin')==false)
        {
            return $this->responseWithMessage('Can not delete user',401);
        }

        $user->delete();
        return $this->responseWithMessage('User has been removed',200);
    }

}
