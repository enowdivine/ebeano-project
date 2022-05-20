<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlightAvailable extends Model
{
    protected $table = 'flight_available';
    protected $guarded = [];
    
    public function flight(){
        return $this->belongsTo(FlightPartners::class,'flight_id');
    }
}
