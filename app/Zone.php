<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $fillable=['name'];

    public function provinces(){
        return $this->hasMany(Province::class);
    }
    public function debts(){
        return $this->hasMany(Debt::class);
    }
}
