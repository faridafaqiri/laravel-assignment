<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Source_type extends Model
{
    protected $fillable=['name'];

    public function source(){
        return $this->belongsTo(Source::class);
    }
}
