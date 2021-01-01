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

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function tastings()
    {
        return $this->hasMany(Tasting::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function types()
    {
        return $this->belongsTo(TypeBeer::class, 'type_beer_id', 'id');
    }
}
