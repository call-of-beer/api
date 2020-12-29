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

    public function store(TastingRequest $tastingRequest, Group $group)
    {
        return $this->tastingService->store($tastingRequest, $group);
    }

    public function destroy(Tasting $tasting)
    {
        $tasting->delete();

        return $this->responseWithData('Tasting has been destroyed', 200);
    }
}
