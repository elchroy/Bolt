<?php

function mostLikedVideos()
{
	$col = topVideos()->take(4)->keys()->map( function ($t) {
		return Bolt\Video::find($t);
	});

	return $col;
}

function mostLikedVideo()
{
	$col = topVideos();
	return topVideos()->first()->first()->favoritable;
}

function getAllLikedVideos()
{
	$col = Bolt\Favorite::where('favoritable_type', 'Bolt\Video')->isLiked()->get();
	dd($col->groupBy('favoritable_id')->sort()->reverse()->first());
	return Bolt\Favorite::where('favoritable_type', 'Bolt\Video')->isLiked()->get();
}

function topVideos()
{
	return getAllLikedVideos()->groupBy('favoritable_id')->sort()->reverse();
}
