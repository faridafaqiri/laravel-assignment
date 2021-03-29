<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $fillable=['provincial_zone_id','zone_id','province_id','source_type_id','total_source','total_pumps','total_active'];

    public function sourceType(){
        return $this->belongsTo(Source_type::class);
    }
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
