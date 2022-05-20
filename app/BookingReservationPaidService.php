<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingReservationPaidService extends Model
{
    protected $table = 'booking_reservation_paid_services';
    protected $guarded = [];
    
    public function service(){
        return $this->belongsTo(BookingPaidService::class,'pad_service_id');
    }
}
