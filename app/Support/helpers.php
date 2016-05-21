<?php

function alpharray()
{
	$alphabets = 'A B C D E F G H I J K L M N O P Q R S T U V W X Y Z';
	$alpharray = explode(" ", $alphabets);

	return $alpharray;
}

function randomFader()
{
	$options = ['rubberBand', 'BounceInRight', 'fadeIn', 'BounceInUp', 'BounceInDown', 'BounceInLeft', 'fadeInRight', 'fadeInUp', 'fadeInDown', 'fadeInLeft', 'slideInRight', 'slideInUp', 'slideInDown', 'slideInLeft'];
	$count = count($options);
	$choice = rand(0, $count - 1);
	return $options[$choice];
}

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
	// ksort($col);
	// dd($col->first()->first()->favoritable);
	return topVideos()->first()->first()->favoritable;
}

function getAllLikedVideos()
{
	return Bolt\Favorite::where('favoritable_type', 'Bolt\Video')->isLiked()->get();
}

function topVideos()
{
	return getAllLikedVideos()->groupBy('favoritable_id')->sort()->reverse();
}
