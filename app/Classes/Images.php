<?php

namespace App\Classes;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
/*
thumbs: 75x75px, 270x195, 270x270, 585x439
*/

class Images
{
    
    protected $thumbs = [
        [75,75,'75x75'],
        [270,195,'270x195'],
        [270,270,'270x270'],
        [585,439,'585x439']
    ];

    public function checkAndCreatePath($path)
    {
        if (!Storage::exists($path)) {
            Storage::makeDirectory($path, 0777, true);
        }
        
    }

    public function createAllThumbs($image, $path)
    {
        $img = Image::make($image);
        foreach ($this->thumbs as $thumb) {
            $new_path = $path . '/' . $thumb[2];
            $this->checkAndCreatePath($new_path);

            $img->resize($thumb[1], $thumb[0]);
            $img->save($new_path . '/');
            $img->reset();
        }
    }

    public function storeUploadedPic($file, $filename, $path)
    {
        return($file->store($path));
    }


}
