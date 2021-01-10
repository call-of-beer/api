<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasting extends Model
{
    use HasFactory;

    protected $table = 'tastings';

    protected $fillable = [
        'title',
        'description'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public function beer()
    {
        return $this->belongsTo(Beer::class, 'beer_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tasting()
    {
        return $this->hasMany(Rating::class);
    }
}
