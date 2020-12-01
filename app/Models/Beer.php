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
        'name',
        'alcohol_content',
        'type_id',
        'producer',
        'description'
    ];
    //public function type()
   // {
   //     return $this->belongTo(Type::class, 'type_id');
   // }

    /**
     * @var string
     */
    protected $table = 'beers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'alcohol_volume', 'country', 'description'
    ];

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
