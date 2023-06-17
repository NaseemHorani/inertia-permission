<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Spatie\ImageOptimizer\Image;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;


if (!function_exists('uploadFile')) {
    function uploadFile($key = "file", $folder = 'projects', $oldFile = false)
    {
        $request = request();
        if ($request->hasFile($key)) {
            if ($oldFile)
                Storage::disk('public')->delete($oldFile);

            $uploadedFile = $request->file($key);
            $moved = Storage::disk('public')->put($folder, $uploadedFile);

            if ($moved)
                return $moved; // url to file
        }
        return $oldFile;
    }
}


function storageImage($file, $default = '')
{
    if (Str::contains($file, 'picsum.photos'))
        return $file;
    if (!empty($file)) {
        return str_replace('\\', '/', Storage::disk('public')->url($file));
    }

    return $default;
}

