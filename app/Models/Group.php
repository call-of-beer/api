<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'moderator_id'];

    protected $table = 'groups';

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'group_user', 'group_id',
            'moderator_id');
    }

    public function tastings()
    {
        return $this->hasMany(Tasting::class);
    }

}
