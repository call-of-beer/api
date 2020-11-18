<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'ratings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'aroma', 'color', 'taste', 'bitterness', 'texture', 'overall', 'comment'
    ];

    public function beers()
    {
        return $this->belongsTo(Beer::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
