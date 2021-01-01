<?php


namespace App\Services;


use App\Models\Beer;
use App\Models\Tasting;
use App\Repositories\GetTastingsRepository;
use App\Repositories\StoreTastingRepository;
use App\Services\Interfaces\TastingServicesInterfaces;
use App\Traits\ResponseDataTrait;
use Illuminate\Support\Facades\DB;

class TastingServices implements TastingServicesInterfaces
{
    use ResponseDataTrait;
    private $gettastingsRepository;
    private $storetastingRepository;

    public function __construct(GetTastingsRepository $gettastingsRepository,
    StoreTastingRepository $storetastingRepository)
    {
        $this->gettastingsRepository = $gettastingsRepository;
        $this->storetastingRepository = $storetastingRepository;
    }

    public function getAll()
    {
        $res = $this->gettastingsRepository->getAllTastings();
        return $res ? $this->responseWithData($res, 200)
            : $this->responseWithMessage('Not found', 404);
    }

    public function getTastingsByGroupId($group)
    {
        $res = $this->gettastingsRepository->getTastingsByGroupId($group);
        return $res ? $this->responseWithData($res, 200)
            : $this->responseWithMessage('Not found', 404);
    }

    public function getTastingById($tasting)
    {
        $res = $this->gettastingsRepository->getTastingById($tasting);
        return $res ? $this->responseWithData($res, 200)
            : $this->responseWithMessage('Not found', 404);
    }

    public function store($data, $group, $beer)
    {
        $res = $this->storetastingRepository->store($data, $group, $beer);
        return $res ? $this->responseWithData($res, 200)
            : $this->responseWithMessage('Tasting has not been stored', 400);
    }
}
