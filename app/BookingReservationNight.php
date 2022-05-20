<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingReservationNight extends Model
{
    protected $table = 'booking_reservation_nights';
    protected $guarded = [];
    
    protected $dates = ['check_in','check_out'];
   public function reservation(){
       return $this->belongsTo(BookingReservation::class,'reservation_id');
   }
   public function room(){
       return $this->belongsTo(BookingRoom::class,'room_id');
   }
}
