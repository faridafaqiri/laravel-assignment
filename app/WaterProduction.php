<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class WaterProduction extends Model
{

    protected $fillable=['zone_id','province_id','provincial_zone_id','active_hours','expense_of_oil',
        'expends','meter_number','produce_water','produce_generator'];

    public function zone(){

        return $this->belongsTo(Zone::class);
    }
    public function provincialZone(){
        return $this->belongsTo(ProvincialZone::class);
    }
    public function province(){
        return $this->belongsTo(Province::class);
    }

  
    public function scopeSpanningIncome($query,$month){
        $query->selectRaw('monthname(created_at) month, count(*) published')
            ->where('created_at','>',Carbon::now()->subMonth($month))
            ->groupBy('month')
            ->latest();
    }
}
