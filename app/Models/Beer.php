<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AlcoholContent;
use App\Models\Type;
use App\Models\Producer;

class Beer extends Model
{
    use HasFactory;

    protected $table = 'beers';

    protected $fillable = [
        'name', 'alcohol_volume', 'country', 'description'
    ];

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function ingredients()
    {
        return $this->hasMany(Ingredients::class);
    }

    public function tasting()
    {
        return $this->belongsTo(Tasting::class, 'beer_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function types()
    {
        return $this->belongsTo(TypeBeer::class, 'typebeer_id', 'id');
    }
}
