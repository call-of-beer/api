<?php

namespace App\Observers;

use App\Models\Tasting;

class TastingObserver
{
    public function saving(Tasting $tasting)
    {
        $tasting->user_id = auth()->user()->id;
    }
}
