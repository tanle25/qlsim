<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function partner()
    {
        # code...
        return $this->hasOne(Partner::class,'id','partner_id');
    }
}
