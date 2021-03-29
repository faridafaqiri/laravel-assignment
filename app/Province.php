<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable=['name','unit','zone_id'];

    public function zone(){
        return $this->belongsTo(Zone::class);
    }
    public function provincial_zones(){
        return $this->hasMany(ProvincialZone::class);
    }
}
