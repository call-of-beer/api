<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grades extends Model
{
    use HasFactory;

    protected $table = 'grades';

    protected $fillable = [
        'value', 'title'
    ];

    public function ingredient()
    {
        return $this->belongsTo(Ingredients::class, 'ingredients_id', 'id');
    }

    public function rating()
    {
        return $this->belongsTo(Rating::class, 'rating_id', 'id');
    }
}
