<?php

namespace App\Http\Facade;

use Illuminate\Support\Facades\Facade;

class UploadFacade extends Facade{
    public static function getFacadeAccessor(){
        return 'upload';
    }
}
