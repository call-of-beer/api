<?php

namespace App\Http\Controllers;

use App\Http\Requests\TastingRequest;
use App\Models\Beer;
use App\Models\Group;
use App\Models\Tasting;
use App\Services\TastingServices;
use App\Traits\ResponseDataTrait;
use Illuminate\Http\Request;

class TastingController extends Controller
{
    use ResponseDataTrait;
    private $tastingService;

    public function __construct(TastingServices $tastingService)
    {
        $this->tastingService = $tastingService;
    }

    public function index()
    {
        return $this->tastingService->getAll();
    }

    public function store(TastingRequest $tastingRequest, Group $group, Beer $beer)
    {
        return $this->tastingService->store($tastingRequest, $group, $beer);
    }

    public function getTastingOfGroup(Group $group)
    {
        return $this->tastingService->getTastingsByGroupId($group);
    }

    public function getTasting(Tasting $tasting)
    {
        return $this->tastingService->getTastingById($tasting);
    }

    public function destroy(Tasting $tasting)
    {
        return $tasting->delete() ? $this->responseWithMessage('Tasting has been destroyed', 200)
            : $this->responseWithMessage('Not found', 404);
    }
}
