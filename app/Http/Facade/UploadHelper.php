<?php

namespace App\Http\Facade;

use Illuminate\Http\UploadedFile;
use Str;

class UploadHelper{

    public function store(UploadedFile $file) :string
    {
        # code...
        $fileName = Str::random(32).'.'.$file->getClientOriginalExtension();
        $file->storeAs('public/invoices/', $fileName);

        return 'storage/invoices/'.$fileName;
    }
}
