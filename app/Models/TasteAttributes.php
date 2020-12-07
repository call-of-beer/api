<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TasteAttributes extends Model
{
    use HasFactory;

    protected $table = 'taste_attributes';

    protected $fillable = [
        'name'
    ];

    public function beer()
    {
        return $this->belongsTo(Beer::class, 'beer_id', 'id');
    }

    public function grading_scale()
    {
        return $this->hasOne(GradingScale::class);
    }
}
