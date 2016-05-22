<?php

namespace Bolt\Http\Controllers\States;

use Illuminate\Http\Request;

use Bolt\Video;
use Bolt\Favorite;
use Bolt\Http\Requests;
use Bolt\Http\Controllers\Controller as Controller;

class VideoState extends Controller
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
    	return $this->groupedLikes->first()->first()->favoritable;
    }

    public function top($number = 10)
    {
    	return $this->groupedLikes->take($number)->keys()->map( function ($t) {
			return Video::find($t);
		});
    }

    public function recent($number = 10)
    {
    	return Video::latest()->take($number)->get();
    }
}
