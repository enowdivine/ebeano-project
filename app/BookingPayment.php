<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingPayment extends Model
{
    protected $table = 'booking_payments';
    protected $guarded = [];
    
    public function client(){
        return $this->belongsTo(BookClients::class,'user_id');
    }
}
