<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image;

class UploadImage
{
    public function upload($file, $path = 'uploads')
    {
        if ($file && $file->isValid()) {
            return $file->store($path, 'public');
        }

        return null;
    }
}
