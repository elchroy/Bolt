<?php

namespace Bolt;

use Bolt\Video;
use Bolt\Category;
use Bolt\Favorite;
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

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
    * Get all of the staff member's photos.
    */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function favors(\Illuminate\Database\Eloquent\Model $model)
    {
        $liked = $this->favored($model);

        return $liked == null ? false : $liked->status;
    }

    public function favored(\Illuminate\Database\Eloquent\Model $model)
    {
        return $this->favorites()->where('favoritable_id', $model->id)->where('favoritable_type', get_class($model))->first();
    }
}
