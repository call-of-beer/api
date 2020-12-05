<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Type;
use App\Models\Producer;

class Beer extends Model
{
    use HasFactory;

    protected $table = 'beers';

    protected $fillable = [
        'name', 'alcohol_volume', 'country', 'description','type_id'
    ];

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function type()
   {
        return $this->belongTo(Type::class, 'type_id');
    }
}
