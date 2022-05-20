<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingReservationTax extends Model
{
    protected $table = 'booking_reservation_taxes';
    protected $guarded = [];
    
    public function tax(){
        return $this->belongsTo(BookingTaxManager::class,'tax_id');
    }
}
