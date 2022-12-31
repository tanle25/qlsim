<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimOwner extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    protected function expired() : Attribute
    {
        # code...
        return Attribute::make(
            get: fn($value)=>Carbon::parse($value)
        );
    }

    public function ownerable()
    {
        # code...
        return $this->morphTo();
    }

    public function getTypeAttribute()
    {
        # code...
        return $this->ownerable_type == User::class ? 'Đại lý' :'Khách lẻ';
    }

    // public function partner()
    // {
    //     # code...
    //     return $this->hasOne(User::class,'id','user_id');
    // }
    public function sim()
    {
        # code...
        return $this->hasOne(SimCard::class,'id','sim_card_id')->withTrashed();
    }
}
