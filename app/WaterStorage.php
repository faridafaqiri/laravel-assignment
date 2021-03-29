<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WaterStorage extends Model
{
    protected $fillable=['water_storage','zone_id','province_id','provincial_zone_id',
        'storage_type','height_type','activation','capacity'];
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
