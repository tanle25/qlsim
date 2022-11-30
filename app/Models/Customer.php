<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function bills()
    {
        # code...
        return $this->hasMany(Bill::class);
    }
    public function bill()
    {
        # code...
        return $this->hasOne(Bill::class);
    }

    public function invoice()
    {
        # code...
        return $this->morphMany(Invoice::class,'invoiceable');
    }
}
