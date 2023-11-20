<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

trait FileTrait
{
    public static function storeImage($old_image, $request_image, $folder)
    {
        if (isset($request_image)) {
            if ($old_image != null) {
                // Replace Image
                $old_image = Str::replace('storage', 'public', $old_image);
                Storage::disk('local')->delete($old_image);
            }
            // Insert New Image
            $dir_image = $request_image->store($folder, 'public');

            // Replace Directory
            $image = Str::replace('public', 'storage', $dir_image);

            return $image;
        }

        return $old_image;
    }
}