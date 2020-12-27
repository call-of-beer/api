<?php

namespace App\Observers;

use App\Models\Beer;

class BeerObserver
{
    public function retrieved(Beer $beer)
    {
        $avgAroma = $beer->ratings()->avg('aroma');
        $avgTaste = $beer->ratings()->avg('taste');
        $avgColor = $beer->ratings()->avg('color');
        $avgBitterness = $beer->ratings()->avg('bitterness');
        $avgTexture = $beer->ratings()->avg('texture');

        $beer->avgAroma = $avgAroma;
        $beer->avgTaste = $avgTaste;
        $beer->avgColor = $avgColor;
        $beer->avgBitterness = $avgBitterness;
        $beer->avgTexture = $avgTexture;
        $beer->overall = ($avgAroma+$avgTaste+$avgColor+$avgBitterness+$avgTexture)/5;

        $beer->save();
    }
}
