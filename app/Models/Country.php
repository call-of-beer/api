<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';

    protected $fillable = [
        'name',
        'shortcut'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d'
    ];

    public function beers()
    {
        return $this->hasMany(Beer::class);
    }
}
