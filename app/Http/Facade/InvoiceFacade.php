<?php

namespace App\Http\Facade;

use Illuminate\Support\Facades\Facade;

class InvoiceFacade extends Facade{

    public static function getFacadeAccessor()
    {
        # code...
        return 'invoice';
    }
}
