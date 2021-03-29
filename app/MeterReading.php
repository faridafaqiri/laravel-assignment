<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeterReading extends Model
{
    protected $fillable=['provincial_zone_id','zone_id','province_id','meter_reader_id','total_read'];

    public function zone(){
        return $this->belongsTo(Zone::class);
    }

    public function provincialZone(){
        return $this->belongsTo(ProvincialZone::class);
    }

    public function province(){
        return $this->belongsTo(Province::class);
    }
    public function meter_reader(){
        return  $this->belongsTo(MeterReader::class);
    }
}
