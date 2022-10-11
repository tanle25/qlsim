<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WifiPackage extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function network()
    {
        # code...
        return $this->hasOne(WifiNetwork::class,'id','wifi_network_id');
    }


}
