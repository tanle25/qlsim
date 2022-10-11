<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimCard extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function partner()
    {
        # code...
        return $this->hasOne(SimOwner::class);
    }
    public function partners()
    {
        # code...
        return $this->hasMany(SimOwner::class);
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
    public function partnerInvoice()
    {
        # code...
       return $this->morphOne(PartnerInvoice::class,'invoiceable');
    }

    public function partnerInvoices()
    {
        # code...
        return $this->morphMany(PartnerInvoice::class,'invoiceable');
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

    public function request()
    {
        # code...
        return $this->hasOne(SimRequest::class);
    }

    public function requests()
    {
        # code...
        return $this->hasMany(SimRequest::class);
    }

    public function network()
    {
        # code...
        return $this->hasOne(SimNetwork::class,'id','sim_network_id');
    }

}
