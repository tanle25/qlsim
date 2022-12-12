<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function sim()
    {
        # code...
        // return $this->hasOne(SimCard::class,'id','sim_card_id');
        return $this->belongsTo(SimCard::class,'sim_card_id','id');
    }

    public function request()
    {
        # code...
        return $this->hasOne(RequestStatus::class,'id','requester');
    }
    public function user()
    {
        # code...
        return $this->hasOne(User::class,'id','user_id');
    }
}
