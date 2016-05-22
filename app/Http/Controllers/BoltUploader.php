<?php

namespace Bolt\Http\Controllers;

use Illuminate\Http\UploadedFile as UploadedFile;
use \Cloudinary as Cloudinary;
use Illuminate\Foundation\Application as App;


class BoltUploader extends Cloudinary
{
	public function __construct(App $app)
	{
		$configData = $app['config']['services.cloudinary'];

    	Cloudinary::config($configData);
	}

    public function uploadAvatar(UploadedFile $file)
    {
    	return 	Cloudinary\Uploader::upload($file, [
		            'crop' => 'limit',
		            'width' => 140,
		            'height' => 140,
		            'format' => 'png'
		        ]);
    }
}
