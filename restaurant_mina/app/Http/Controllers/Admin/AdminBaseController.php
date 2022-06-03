<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use File;

class AdminBaseController extends Controller
{
    //
    /**
     * uplaod the image and thumbnail if required
     * @param uploaded_image ($image), $thumbnail $path, $thumbnail_height and $thubnail_width
     * @return image_name
     */
    public function uploadImage($image, $thumbnail = false, $path, $height = 100, $width = 100)
    {
        //create the parent directory 
        $this->createDirectoryIFNotExists($path);
        $name = time() . '.' . $image->getClientOriginalExtension();
        //only resize if thumbnail is required
        if ($thumbnail):
            //create the image thumbnail using the intervention image package
            $this->generateDifferentSizeImages($image,$name,$height,$width,$path."/thumbnails");
            $this->generateDifferentSizeImages($image,$name,'150','150',$path."/small");
            $this->generateDifferentSizeImages($image,$name,'300','300',$path."/medium");
            $this->generateDifferentSizeImages($image,$name,'500','500',$path."/large");
        endif;
        //save the large image in the file system
        $destinationPath = $path;
        $image->move($destinationPath, $name);
        return $name;

    }

    /**
     * function to generate the different size image
     * @param $image, $name, $height, $width, $path
     * @return void
     */
    protected function generateDifferentSizeImages($image,$name,$height, $width,$path){
        $this->createDirectoryIFNotExists($path);
        $img = Image::make($image->getRealPath());
        $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
        })->save($path . '/' . $name);
    }


    /**
     * function to create the directory if not exits
     * @param $directory_path
     * @return void
     */
    protected function createDirectoryIFNotExists($directory_path){
        if(!File::isDirectory(asset($directory_path))){
            File::makeDirectory(asset($directory_path));
        }
    }

     /**
     * remove the old image
     * @param $directory_path
     * @return void
     */
    protected function removeImages($directory_path,$image){
        //remove the old actual images
        if(File::exists($directory_path.'/'.$image)){
            File::delete($directory_path .'/'. $image);
        }

        //remove the thumbnails
        if(File::exists($directory_path.'/thumbnails/'.$image)){
            File::delete($directory_path .'/thumbnails/'. $image);
        }
        //remvoe the small images
        if(File::exists($directory_path.'/small/'.$image)){
            File::delete($directory_path .'/small/'. $image);
        }
        //remove the medium images
        if(File::exists($directory_path.'/medium/'.$image)){
            File::delete($directory_path .'/medium/'. $image);
        }
        //remove the large images
        if(File::exists($directory_path.'/large/'.$image)){
            File::delete($directory_path .'/large/'. $image);
        }
    }


}
