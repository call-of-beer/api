<?php


namespace App\Repositories;


use App\Models\Rating;
use App\Repositories\Base\BaseRepository;
use App\Repositories\Interfaces\GetRatingsRepositoryInterface;
use Illuminate\Support\Facades\DB;

class GetRatingsRepository extends BaseRepository implements GetRatingsRepositoryInterface
{
    public function getAll()
    {
        return Rating::with(['beer', 'comment', 'user'])
            ->get();
    }

    public function getRatingOfBeer($beer)
    {
        return DB::table('ratings')
            ->where('beer_id', $beer->id)
            ->get();
    }

    public function getRatingOfUser($user)
    {
        return DB::table('ratings')
            ->where('user_id', $user->id)
            ->get();
    }

    public function getById($id)
    {
        return DB::table('ratings')
            ->where('id', $id)
            ->get();
    }

    public function getAvgRatingByTasting($tasting)
    {
        // TODO: Implement getAvgRatingByTasting() method.
    }

    public function getAllMy()
    {
        // TODO: Implement getAllMy() method.
    }
}
