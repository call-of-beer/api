<?php


namespace App\Traits;


trait ResponseRatingByTastingTrait
{
    public function getResponseRatingByTasting($tasting, $avgAroma, $avgColor, $avgTaste, $avgBitterness, $avgTexture, $status)
    {
        return response()->json([
            'tasting_id' => $tasting->id,
            'aroma' => $avgAroma,
            'color' => $avgColor,
            'taste' => $avgTaste,
            'bitterness' => $avgBitterness,
            'texture' => $avgTexture
        ], $status);
    }

}
