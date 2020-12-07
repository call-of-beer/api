<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredients extends Model
{
    use HasFactory;

    protected $table = 'ingredients';

    protected $fillable = [
        'name'
    ];

    public function beer()
    {
        return $this->belongsTo(Beer::class, 'beer_id', 'id');
    }

    public function grades()
    {
        return $this->hasMany(Grades::class);
    }
}
