<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\UserRole;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     protected $guarded=['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function getStatusAttribute()
    // {
    //     # code...
    //     $status = $this->status == 0 ? 'Disable' : 'Active';
    //     return $status;
    // }
    public function scopeNotRole(Builder $query, $roles, $guard = null): Builder
    {
         if ($roles instanceof Collection) {
             $roles = $roles->all();
         }

         if (! is_array($roles)) {
             $roles = [$roles];
         }

         $roles = array_map(function ($role) use ($guard) {
             if ($role instanceof Role) {
                 return $role;
             }

             $method = is_numeric($role) ? 'findById' : 'findByName';
             $guard = $guard ?: $this->getDefaultGuardName();

             return $this->getRoleClass()->{$method}($role, $guard);
         }, $roles);

         return $query->whereHas('roles', function ($query) use ($roles) {
             $query->where(function ($query) use ($roles) {
                 foreach ($roles as $role) {
                     $query->where(config('permission.table_names.roles').'.id', '!=' , $role->id);
                 }
             });
         });
    }

    public function partner()
    {
        # code...
        return $this->hasOne(Partner::class,'id','partner_id');
    }

    public function partnerRole()
    {
        # code...
        return $this->hasOne(UserRole::class);
    }
    public function sims()
    {
        # code...
        return $this->hasMany(SimOwner::class);
    }




}
