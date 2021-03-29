<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DistributedBill extends Model
{
    protected $fillable=['provincial_zone_id','zone_id','province_id','total_distributed'];

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

