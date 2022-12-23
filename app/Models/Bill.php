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
        return $this->morphTo()->withTrashed();
    }

    public function partner()
    {
        # code...
        return $this->hasOne(Partner::class,'id','partner_id');
    }
    public function packageable()
    {
        # code...
        return $this->morphTo();
    }
}
