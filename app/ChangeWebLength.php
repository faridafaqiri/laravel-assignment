<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChangeWebLength extends Model
{
    protected $fillable=['zone_id','province_id','provincial_zone_id','tran_dist','length'];

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
