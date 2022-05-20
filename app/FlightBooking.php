<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlightBooking extends Model
{
    protected $table = 'flight_booking';
    protected $guarded = [];
    
    public function flight(){
        return $this->belongsTo(FlightPartners::class,'flight_id');
    }
    
    public function flight_available(){
        return $this->belongsTo(FlightAvailable::class,'flight_available_id');
    }
}
