<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class Helper
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function removeFile($file)
    {
        $filePath = str_replace('/storage/', '', parse_url($file, PHP_URL_PATH));
        if (Storage::disk('public')->exists($filePath)) {
            logger("File exists: $filePath"); // Laravel log
            Storage::disk('public')->delete($filePath);
        } else {
            logger("File NOT found: $filePath");
        }
    }

    public function uploadFile($file,$path)
    {
        if(isset($file) && is_object($file)){
            $fileLocation = $file->store($path, 'public');
            return '/storage/'.$fileLocation;
        }
        return $file;
    }
}
