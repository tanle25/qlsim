<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerPackage extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function package()
    {
        # code...
        return $this->hasOne(Pakage::class,'id','pakage_id');
    }
}
