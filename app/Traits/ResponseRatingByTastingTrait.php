<?php


namespace App\Traits;


trait ResponseRatingByTastingTrait
{
    public function getResponseRatingByTasting($avgAroma, $avgColor, $avgTaste, $avgBitterness, $avgTexture, $status)
    {
        return response()->json([
            'aroma' => $avgAroma,
            'color' => $avgColor,
            'taste' => $avgTaste,
            'bitterness' => $avgBitterness,
            'texture' => $avgTexture
        ], $status);
    }

}
