<?php
/**
 * Created by PhpStorm.
 * User: Michael's Account
 * Date: 5/17/2016
 * Time: 5:42 PM
 */

namespace App\Libraries;

use Image;


class Upload
{
    /**
     * Upload image using intervention image
     *
     * @param $image
     * @return string
     */
    public function uploadImage($image,$userID){
        $extension = $image->getClientOriginalExtension();
        $imageName = $this->randomString(32).'.'.$extension;
        $this->makeDirectory($userID);
        $path = 'uploads/Users/'.$userID.'/'.$imageName;
        $img = Image::make($image);

        $img->resize(800, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->encode('jpg',10)->save('uploads/Users/'.$userID.'/'.'banner_'.$imageName);

        $img->resize(375, null, function ($constraint){
            $constraint->aspectRatio();
        });
        $img->encode('jpg',10)->save('uploads/Users/'.$userID.'/'.$imageName);

        return $imageName;
    }

    public function deleteImage($image){
        //delete specified image from directory
    }

    public function makeDirectory($userID){
        $path = 'uploads/Users/'.$userID;

        if(!file_exists($path)){
            mkdir($path);
        }


    }

    function filenameSafe($name) {
        $except = array('\\', '/', ':', '*', '?', '"', '<', '>', '|');
        return str_replace($except, '', $name);
    }

    /**
     *
     * Generate random secure string for image storage
     *
     * @param $length
     * @param string $keyspace
     * @return string
     */
    public function randomString($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'){
        $str = '';
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }
        return $str;
    }

}