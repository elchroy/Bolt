<?php

namespace Bolt;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name', 'brief',
    ];

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function numberOfVideos()
    {
        return count($this->videos()->get());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeHasVideo()
    {
        return self::all()->filter(function ($cat) {
            return $cat->videos->count() > 0;
        }
        );
    }
}
