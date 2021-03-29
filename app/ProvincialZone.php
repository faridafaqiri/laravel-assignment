<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProvincialZone extends Model
{
    protected $fillable=['name','province_id'];

    public function province(){
        return $this->belongsTo(Province::class);
    }
    public function customers(){
        return $this->hasMany(Customer::class);
    }
    public function leakages(){
        return $this->hasMany(Leakage::class);
    }
    public function impaired_pumps(){
        return $this->hasMany(ImpairedPump::class);
    }

    public function signboards(){
        return $this->hasMany(Signboard::class);
    }
    public function meter_changes(){
        return $this->hasMany(MeterChange::class);
    }
    public function sources(){
        return $this->hasMany(Source::class);
    }
    public function assets(){
        return $this->hasMany(Asset::class);
    }
    public function faucet_change(){
        return $this->hasMany(FaucetChange::class);
    }
    public function illegal_customers(){
        return $this->hasMany(IllegalCustomer::class);
    }
    public function water_productions(){
        return $this->hasMany(WaterProduction::class);
    }
    public function water_storages(){
        return $this->hasMany(WaterStorage::class);
    }
    public function water_distribution(){
        return $this->hasMany(WaterDistribution::class);
    }
    public function incomes(){
        return $this->hasMany(Income::class);
    }

    public function users(){

        return $this->belongsToMany(User::class);

    }

}

