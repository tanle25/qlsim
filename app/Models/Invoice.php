<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $appends = ['model_name'];

    public function getModelNameAttribute()
    {
        $status = config('constrain.invoice');
        return $status[$this->type];
    }

    public function invoiceable()
    {
        # code...
        return $this->morphTo();
    }

    public function bill()
    {
        # code...
        return $this->hasOne(Bill::class,'id','bill_id');
    }
}
