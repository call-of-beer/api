<?php


namespace App\Services;


use App\Models\Beer;
use App\Models\Rating;
use App\Repositories\GetRatingsRepository;
use App\Services\Interfaces\GetRatingServiceInterface;
use App\Traits\ResponseDataTrait;
use App\Traits\ResponseRatingByTastingTrait;
use Illuminate\Support\Facades\DB;

class GetRatingService implements GetRatingServiceInterface
{
    use ResponseDataTrait;
    use ResponseRatingByTastingTrait;

    private $getRatingsRepository;

    public function __construct(GetRatingsRepository $getRatingsRepository)
    {
        $this->getRatingsRepository = $getRatingsRepository;
    }

    public function getAll()
    {
        $rating = $this->getRatingsRepository->getAll();
        return $this->responseWithData($rating, 200);
    }

    public function getRatingOfBeer($beer)
    {
        $selected = $this->getRatingsRepository->getRatingOfBeer($beer);
        return $this->responseWithData($selected, 200);
    }

    public function getRatingOfUser($user)
    {
        $selected = $this->getRatingsRepository->getRatingOfUser($user);
        return $this->responseWithData($selected, 200);
    }

    public function getRatingById($rating)
    {
        $selected = $this->getRatingsRepository->getRatingById($rating);
        return $this->responseWithData($selected, 200);
    }

    public function getAvgRatingByTasting($tasting)
    {
        $avgAroma = DB::table('ratings')
            ->where('tasting_id', '=', $tasting->id)
            ->avg('aroma');

        $avgColor = DB::table('ratings')
            ->where('tasting_id', '=', $tasting->id)
            ->avg('color');

        $avgTaste = DB::table('ratings')
            ->where('tasting_id', '=', $tasting->id)
            ->avg('taste');

        $avgBitterness = DB::table('ratings')
            ->where('tasting_id', '=', $tasting->id)
            ->avg('bitterness');

        $avgTexture = DB::table('ratings')
            ->where('tasting_id', '=', $tasting->id)
            ->avg('texture');

        return $this->getResponseRatingByTasting(
            $avgAroma,
            $avgColor,
            $avgTaste,
            $avgBitterness,
            $avgTexture, 200);
    }
}
