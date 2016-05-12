<?php

namespace Bolt;

use Illuminate\Database\Eloquent\Model;
use Bolt\User;
use Bolt\Category;
use Bolt\Comment;
use Bolt\Favorite;

class Video extends Model
{
    protected $fillable = [
        'title', 'url', 'description', 'category_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function linkId()
    {
        $p = (explode('=', $this->url));
        return end($p);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function urlHost()
    {
        preg_match('@^(?:http://)?(?:https://)?([^/]+)@i', $this->url, $matches);
        $host = $matches[1];
        return $host;
    }

    public function srcFrame()
    {
        $srcFrame = "http://" . $this->urlHost() . '/embed/' . $this->linkId();
        return $srcFrame;
    }

    public function shortTitle()
    {
        return substr($this->title, 0, 10);
    }

    public function favorites()
    {
        return $this->morphMany('Bolt\Favorite', 'favoritable');
    }
}
