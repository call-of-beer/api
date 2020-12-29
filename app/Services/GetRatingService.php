<?php


namespace App\Services;


use App\Models\Beer;
use App\Models\Rating;
use App\Services\Interfaces\GetRatingServiceInterface;
use App\Traits\ResponseDataTrait;
use Illuminate\Support\Facades\DB;

class GetRatingService implements GetRatingServiceInterface
{
    use ResponseDataTrait;

    public function getAll()
    {
        $rating = Rating::with(['beer', 'comment', 'user'])->get();
        return response()->json($rating, 200);
    }

    public function getRatingOfBeer($beer)
    {
        $selected = Rating::where('beer_id', $beer->id)->get();

        return $this->responseWithData($selected, 200);
    }

    public function getRatingOfUser($user)
    {
        $selected = DB::table('ratings')
            ->where('user_id', $user->id)
            ->get();

        return $this->responseWithData($selected, 200);
    }

    public function getRatingById($rating)
    {
        $selected = DB::table('ratings')
            ->where('id', $rating->id)
            ->get();

        return $this->responseWithData($selected, 200);
    }

    public function getAverageAroma($beer)
    {
        $getBeer = Beer::find($beer->id);
        $avgAroma = $getBeer->ratings()->avg('aroma');
//        $avgTaste = $getBeer->ratings()->avg('taste');
//        $avgColor = $getBeer->ratings()->avg('color');
//        $avgBitterness = $getBeer->ratings()->avg('bitterness');
//        $avgTexture = $getBeer->ratings()->avg('texture');

         return $avgAroma;
    }
}
