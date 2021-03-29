<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeterReader extends Model
{
    protected $fillable=['provincial_zone_id','zone_id','province_id','name','age','address','degree','area'];

    public function zone(){
        return $this->belongsTo(Zone::class);
    }

    public function provincialZone(){
        return $this->belongsTo(ProvincialZone::class);
    }

    public function province(){
        return $this->belongsTo(Province::class);
    }

    public function meter_reading(){
        return $this->hasMany(MeterReading::class);
    }
}
