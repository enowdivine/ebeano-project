<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingAmenity extends Model
{
    protected $table = 'booking_amenities';
    protected $guarded = [];
    
    use SoftDeletes;
    public function roomType(){
       return $this->belongsToMany(BookingRoomType::class,'room_type_pivot_amenity','amenity_id','room_type_id');
    }
}
