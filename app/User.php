<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','is_superuser','is_staff',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value){
        $this->attributes['password']=bcrypt($value);
    }

    public function isSuperUser(){
        return $this->is_superuser;
    }
    public function isStaffUser(){
        return $this->is_staff;
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }
    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }

    public function provincialZones(){
        return $this->belongsToMany(ProvincialZone::class);
    }

    public function hasRole($roles){

        return !! $roles->intersect($this->roles)->all();
    }
    public function hasPermission($permission){
        return $this->permissions->contains('name',$permission->name)  || $this->hasRole($permission->roles);
    }

    public function hasProvincialZone($provincialZone){

        return $this->provincialZones->contains('name',$provincialZone->name);
    }

}
