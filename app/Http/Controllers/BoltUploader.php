<?php

namespace Bolt\Http\Controllers;

use Illuminate\Http\UploadedFile as UploadedFile;
use \Cloudinary as Cloudinary;

class BoltUploader extends Cloudinary
{
	public function __construct()
	{
		Cloudinary::config([
          'cloud_name'  => 'dax1lcajn',
          'api_key'     => '724974163436624',
          'api_secret'  => 'LEGPtwbA-YFzAbfRsbOSK4Dvodc',
        ]);
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
