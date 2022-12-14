<?php

namespace App\Models;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class SimCard extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    protected $casts=[
        'is_rent'=>'boolean'
    ];

    public static function boot(){
        parent::boot();
        static::deleting(function($sim){
            $sim->deleted_by = Auth::user()->id;
            $sim->save();
        });
        static::restoring(function($sim){
            $sim->deleted_by = null;
            $sim->save();
        });
    }

    public function delete_by()
    {
        # code...
        return $this->hasOne(User::class,'id','deleted_by');
    }

    protected function expired() : Attribute
    {
        # code...
        return Attribute::make(
            get: fn($value)=>Carbon::parse($value)
        );
    }

    public function partner()
    {
        # code...
        return $this->hasOne(SimOwner::class);
        // return $this->hasOneThrough(User::class, SimOwner::class,'user_id','id');
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
       return $this->hasMany(Invoice::class);
    }

    public function last_invoice()
    {
        # code...
        return $this->hasOne(Invoice::class)->latest();
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

    public function histories()
    {
        # code...
        return $this->hasMany(History::class);
    }



}
