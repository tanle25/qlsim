<?php

namespace App\Models;

use App\Models\Bill;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WifiRequest extends Model
{
    use HasFactory;
    protected $guarded =  ['id'];


    public function customer()
    {
        # code...
        return $this->hasOne(Customer::class,'id','customer_id');
    }
    public function partner()
    {
        # code...
        return $this->hasOne(Partner::class,'id','wifi_package_id');
    }
    public function package()
    {
        # code...
        return $this->hasOne(WifiPackage::class,'id','wifi_package_id');
    }
    public function bill()
    {
        # code...
        return $this->morphOne(Bill::class,'modelable');
    }
    public function bills()
    {
        # code...
        return $this->morphMany(Bill::class,'modelable');
    }

    public function invoice()
    {
        # code...
        return $this->morphOne(Invoice::class,'invoiceable');
    }
    public function invoices()
    {
        # code...
        return $this->morphMany(Invoice::class,'invoiceable');
    }

    public function partnerInvoice()
    {
        # code...
        return $this->morphOne(partnerInvoice::class,'invoiceable');
    }
    public function partnerInvoices()
    {
        # code...
        return $this->morphMany(partnerInvoice::class,'invoiceable');
    }
}
