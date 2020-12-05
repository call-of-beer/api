<?php


namespace App\Services;


use App\Models\Beer;
use App\Models\Tasting;
use App\Services\Interfaces\JoinBeerToTastingServiceInterface;
use App\Traits\ResponseDataTrait;

class joinBeerToTastingService implements JoinBeerToTastingServiceInterface
{
    use ResponseDataTrait;
    public function joinBeerToTasting($beer, $tasting)
    {
        $beer = Beer::find($beer);

        $beer->tasting()->associate(Tasting::find($tasting));

        $beer->save();

        return $this->responseWithMessage('Beer has been joined to Tasting', 200);
    }
}
