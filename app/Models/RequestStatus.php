<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestStatus extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function sim()
    {
        # code...
        return $this->hasOne(SimCard::class,'id','sim_card_id');
    }

    public function partner()
    {
        # code...
        return $this->hasOne(Partner::class,'id','partner_id');
    }
}
