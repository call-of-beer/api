<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent;

/**
 * @mixin \Eloquent
 * @mixin \Illuminate\Database\Eloquent\Builder
 */

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'moderator_id'];

    protected $table = 'groups';

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'group_user', 'group_id',
            'moderator_id');
    }

    public function getUserId()
    {
        $user = $this->users()->pluck('id');
        return $this->getGroupsOfUser($user);
    }

    public function getGroupsOfUser($user)
    {
        $user = is_array($user) ? $user : [$user];

        return Group::whereHas('users', function($query) use($user){
            $query->whereIn('id', $user);
        })->get();
    }

    public function tastings()
    {
        return $this->hasMany(Tasting::class);
    }

}
