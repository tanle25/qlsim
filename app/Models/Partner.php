<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function sims()
    {
        # code...
        return $this->hasMany(SimOwner::class);
    }
    public function requests()
    {
        # code...
        return $this->hasMany(SimRequest::class);
    }

    public function invoices()
    {
        # code...
        return $this->hasMany(PartnerInvoice::class);
    }

    public function users()
    {
        # code...
        return $this->hasMany(User::class);
    }

    public function statuss()
    {
        # code...
        return $this->hasMany(RequestStatus::class);
    }



}
