<?php

namespace Bolt\Http\Repositories;

use Bolt\Favorite;
use Bolt\Http\Controllers\Controller;
use Bolt\Video;

class VideoRepository extends Controller
{
    protected $groupedLikes;

    public function __construct()
    {
        $this->groupedLikes = $this->groupedLikes();
    }

    public function groupedLikes()
    {
        return $this->likedVideos()->groupBy('favoritable_id')->sort()->reverse();
    }

    public function likedVideos()
    {
        return Favorite::where('favoritable_type', 'Bolt\Video')->isLiked()->get();
    }

    public function mostLiked()
    {
        $result = (null != $this->groupedLikes->first()) ? $this->groupedLikes->first()->first()->favoritable : $this->recent(1)->first();

        return $result;
    }

    public function top($number = 10)
    {
        return $this->groupedLikes->take($number)->keys()->map(function ($t) {
            return Video::find($t);
        });
    }

    public function recent($number = 10)
    {
        return $this->latestVid()->take($number)->get();
    }

    public function getLatest($number = 10)
    {
        return $this->latestVid()->paginate($number);
    }

    public function latestVid()
    {
        return Video::latest();
    }

    public function findVideo($id)
    {
        return Video::find($id);
    }

    public function searchVids($search, $number = 10)
    {
        $condition = env('DB_CONNECTION') == 'pgsql' ? 'ILIKE' : 'LIKE';

        return Video::where('title', $condition, "%$search%")->latest()->paginate($number);
    }
}
