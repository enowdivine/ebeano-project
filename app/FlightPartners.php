<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlightPartners extends Model
{
    protected $table = 'flight_partners';
    protected $guarded = [];
    
    public function client(){
        return $this->belongsTo(BookClients::class,'user_id');
    }
}
