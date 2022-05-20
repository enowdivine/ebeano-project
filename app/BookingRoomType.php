<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingRoomType extends Model
{
    protected $table = 'room_types';
    protected $guarded = [];
    
    public function amenity(){
        return $this->belongsToMany(BookingAmenity::class,'room_type_pivot_amenity','room_type_id','amenity_id');
    }
    public function roomTypeImage(){
        return $this->hasMany(BookingRoomTypeImage::class,'room_type_id');
    }
    public function regularPrice(){
        return $this->hasOne(BookingRegularPrice::class,'room_type_id');
    }
    public function specialPrice(){
        return $this->hasMany(BookingSpecialPrice::class,'room_type_id');
    }
    public function paidService(){
        return $this->belongsToMany(BookingPaidService::class,'paid_service_pivot_room_type','room_type_id','paid_service_id');
    }
    public function room(){
        return $this->hasMany(BookingRoom::class,'room_type_id');
    }
    public function reservation(){
        return $this->hasMany(BookingReservation::class,'room_type_id');
    }
    public function availableRoom($date){
       return  $this->room()->with(['reservedRoom'=>function($q) use($date){
            $q->where('date',$date);
        }])->get();

    }
    public function featuredImage(){
        return $this->roomTypeImage->where('featured',1)->first();
    }
    public function getDayByRegularPrice($day){
        if($price = $this->regularPrice){
            $day_col ='day_'.$day;
            $amount_col =$day_col.'_amount';
            return [
                'amount_type'=>$price->$day_col,
                'amount'=>$price->$amount_col

            ];
        }else{
            return [
                'amount_type'=>'ADD',
                'amount'=>0

            ];
        }
    }
    public function getDayByCurrentPrice($day){
        $base_price = $this->base_price;
        $price = $base_price;
        if($special_price=false){

        }else{
           $regular_price = $this->getDayByRegularPrice($day);
           if($regular_price['amount_type'] === 'ADD'){
               $price += $regular_price['amount'];
           }elseif ($regular_price['amount_type'] === 'LESS'){
               $price -= $regular_price['amount'];
           }
        }
        return $price;
    }
}
