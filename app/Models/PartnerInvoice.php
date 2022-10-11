<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerInvoice extends Model
{
    use HasFactory;
    protected $guarded=['id'];

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
}
