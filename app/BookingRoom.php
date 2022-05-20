<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingRoom extends Model
{
    use SoftDeletes;
    protected $table = 'booking_rooms';
    protected $guarded = [];
    
    public function type(){
        return $this->belongsTo(BookingRoomType::class,'room_type_id');
    }
    public function floor(){
        return $this->belongsTo(BookingFloor::class,'floor_id');
    }
    public function reservedRoom(){
        return $this->hasMany(BookingReservationNight::class,'room_id');
    }
    public function available($date){
        return  BookingReservationNight::where('room_id',$this->id)->whereHas('reservation',function ($q){
           $q->whereNotIn('status',['CANCEL','ONLINE_PENDING']);
       })->where('date',$date)->first();
    }
}
