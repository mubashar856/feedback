<?php

    namespace App\Utils;


class Util {
    public static function deleteImage($path , $fileName){
        if($fileName != 'default.png'){
            if(unlink(public_path('uploads/'.$path.'/'.$fileName))){
                return true;
            }
        }
        return false;
    }

    

}