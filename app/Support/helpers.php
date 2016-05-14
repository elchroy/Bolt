<?php

function alpharray()
{
	$alphabets = 'A B C D E F G H I J K L M N O P Q R S T U V W X Y Z';
	$alpharray = explode(" ", $alphabets);

	return $alpharray;
}

function randomFader()
{
	$options = ['fadeInRight', 'fadeInUp', 'fadeInDown', 'fadeInLeft'];
	$choice = rand(0, 3);
	return $options[$choice];
}