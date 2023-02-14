<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

Trait StyleTrait
{
    function saveImage($photo, $folder){
        //save photo in folder
        $file_extension = $photo -> getClientOriginalExtension();
        $file_name = time() . Auth::id() . '.' .$file_extension;
        $path = $folder;
        $photo -> move($path, $file_name);
        return $file_name;
    }
}