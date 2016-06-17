<?php

namespace Bolt\Http\Controllers;

use Cloudinary;
use Cloudinary\Uploader as Uploader;
use Illuminate\Foundation\Application as App;
use Illuminate\Http\UploadedFile as UploadedFile;

class BoltUploader extends Cloudinary
{
    public function __construct(App $app)
    {
        $configData = $app['config']['services.cloudinary'];

        Cloudinary::config($configData);
    }

    public function uploadAvatar(UploadedFile $file)
    {
        return    Uploader::upload($file, [
                    'crop'   => 'limit',
                    'width'  => 140,
                    'height' => 140,
                    'format' => 'png',
                ]);
    }
}
