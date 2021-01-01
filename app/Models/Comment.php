<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];

    public function tasting()
    {
        return $this->belongsTo(Tasting::class, 'tasting_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
