<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebLength extends Model
{
   protected $fillable=['zone_id','province_id','provincial_zone_id','distributive_web_length','transitive_web_length'];

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
