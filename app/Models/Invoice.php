<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts =[
        'from_date'=>'date:d-m-Y',
        'to_date'=>'date:d-m-Y',
    ];

    // public function getModelNameAttribute()
    // {
    //     $status = config('constrain.invoice');
    //     return $status[$this->type];
    // }

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

    public function sim()
    {
        # code...
        return $this->hasOne(SimCard::class, 'id','sim_card_id');
    }

    public function getTypeAttribute()
    {
        # code...

        $type = '';
        if($this->invoiceable_type == User::class){
            $type = $this->invoiceable->roles[0]->name;
        }else{
            $type = 'custommers';
        }

        return __($type);
    }


}
