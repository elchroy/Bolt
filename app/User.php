<?php

namespace Bolt;

use Bolt\Video;
use Bolt\Category;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'social_link', 'social_id', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
