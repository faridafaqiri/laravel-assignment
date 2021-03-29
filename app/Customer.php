<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable=['provincial_zone_id','zone_id','province_id','business','residential','holy_places'
        ,'public_places','faucet_type','governmental','unknown','old_new'];

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
