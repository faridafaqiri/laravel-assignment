<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoveredPopulation extends Model
{
    protected $fillable=['zone_id','population','year','m_residential'
        ,'m_business','m_holyPlaces','m_public','m_governmental'];

    public function zone(){
        return $this->belongsTo(Zone::class);
    }
}
