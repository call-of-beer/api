<?php

namespace App\Http\Controllers;

use App\Models\Beer;
use App\Models\GradingScale;
use App\Models\Ingredients;
use App\Models\TasteAttributes;
use App\Models\Tasting;
use App\Services\CreateRatingService;
use App\Services\GetRatingService;
use App\Services\GradeService;
use App\Traits\ResponseDataTrait;
use Illuminate\Http\Request;
use App\Services\StoreUpdateDeleteRatingService;
use App\Services\ErrorService;
use App\Models\Rating;
use App\Http\Requests\StoreRating;

class RatingController extends Controller
{
    use ResponseDataTrait;
    private $storeDeleteRatingService;
    private $getRatingService;

    public function __construct(
        StoreUpdateDeleteRatingService $storeDeleteRatingService,
        GetRatingService $getRatingService)
    {
        $this->storeDeleteRatingService = $storeDeleteRatingService;
        $this->getRatingService = $getRatingService;
    }

    public function getAll()
    {
        return $this->getRatingService->getAll();
    }

    public function store(Beer $beer, StoreRating $storeRating, Tasting $tasting)
    {
        return $this->storeDeleteRatingService->store($beer, $storeRating, $tasting);
    }

    public function getSelected(Beer $beer)
    {
        return $this->getRatingService->getRatingOfBeer($beer);
    }

    public function show(Rating $rating)
    {
        return $this->getRatingService->getRatingById($rating);
    }

    public function edit(StoreRating $request, Rating $rating)
    {
        return $this->storeDeleteRatingService->editRating($rating, $request);
    }

    public function delete(Rating $rating)
    {
        return $this->storeDeleteRatingService->delete($rating);
    }

    public function getAvgRatingsByTasting(Tasting $tasting)
    {
        return $this->getRatingService->getAvgRatingByTasting($tasting);
    }
}
