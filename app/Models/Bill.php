<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    public function customer()
    {
        # code...
        return $this->hasOne(Customer::class,'id','customer_id');
    }
    public function modelable()
    {
        # code...
        return $this->morphTo();
    }
}
