<?php
namespace App\Http\Services;

use Intervention\Image\ImageManagerStatic;

trait ImageFilter
{
    public function resize($image, $width = 400, $height = 400)
    {
        $file_ext  = $image->extension();
        $temp = $image->getPathName();
        $imgFile = ImageManagerStatic::make($temp);
        $imgFile->resize(config($width, 800), config($height, 800), function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            }); // resizing image
        $imgFile->save($temp,90,$file_ext);

        return $image;
    }
}
