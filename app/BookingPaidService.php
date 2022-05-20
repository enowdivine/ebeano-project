<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingPaidService extends Model
{
    use SoftDeletes;
    
    protected $table = 'booking_paid_services';
    protected $guarded = [];
    
    public function rooms()
    {
        return $this->belongsTo(BookingRooms::class);
    }
}
