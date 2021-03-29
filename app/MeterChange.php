<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeterChange extends Model
{
    protected $fillable=['total','zone_id','province_id','provincial_zone_id','type'];

    public function zone(){
        return $this->belongsTo(Zone::class);
    }

    public function provincialZone(){
        return $this->belongsTo(ProvincialZone::class);
    }

    public function province(){
        return $this->belongsTo(Province::class);
    }
}
