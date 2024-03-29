<?php

namespace App\Traits;

use File;
use Illuminate\Http\Request;

trait FileUploadTrait
{

    function uploadImage(Request $request, $inputName, $oldPath = NULL, $path = "/uploads")
    {
        // 1) Get image in request
        // 2) Get extension from image
        // 3) Create unique image name
        // 4) Take image and move to public path
        // 5) return image path

        if ($request->hasFile($inputName)) {

            $image = $request->{$inputName};
            $ext = $image->getClientOriginalExtension();
            $imageName = 'media_' . uniqid() . '.' . $ext;

            $image->move(public_path($path), $imageName);

            if ($oldPath && File::exists(public_path($oldPath))) {
                File::delete(public_path($oldPath));
            }

            return $path . '/' . $imageName;
        }

        return NULL;
    }

    function removeImage(string $path): void
    {
        if (File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}
