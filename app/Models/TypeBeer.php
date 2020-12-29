<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeBeer extends Model
{
    use HasFactory;

    protected $table = 'type_beers';

    protected $fillable = 'name';

    public function beers()
    {
        return $this->hasMany(Beer::class);
    }
}
