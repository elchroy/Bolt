<?php

namespace Bolt;

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

    public function getAvatar()
    {
        return $this->hasAvatar() ? $this->avatar : asset('uploads/def_profile.png');
    }

    public function owns(\Illuminate\Database\Eloquent\Model $model)
    {
        return $this->id == $model->user_id;
    }

    private function hasAvatar()
    {
        return $this->avatar != null;
    }
    
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function favoriteVideos()
    {
        $videoLikes = $this->favorites()->isVideo()->get();
        $favVids = $videoLikes->map(function ($f) {
            return $f->favoritable;
        });

        return $favVids;
    }

    public function numFavVids()
    {
        return count($this->favoriteVideos());
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
