<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingClients extends Model
{
    protected $table = "booking_clients";
    protected $guarded = [];
    
    protected $appends =['full_name'];
    
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    
    public function getFullNameAttribute(){
        return $this->first_name.' '.$this->last_name;
    }
    public function picture_path(){
        if($this->picture === null){
            return asset('assets/booking/assets/backend/image/no-img.png');
        }
        return asset('assets/booking/assets/backend/image/guest/pic/'.$this->picture);
    }
    public function id_card_path(){
        if($this->picture === null){
            return asset('assets/booking/assets/backend/image/no-img.png');
        }
        return asset('assets/booking/assets/backend/image/guest/card_image/'.$this->id_card_image);
    }
    public function sex(){
        if($this->sex === 'M'){
            return 'Male';
        }
        if($this->sex === 'F'){
            return 'Female';
        }
        if($this->sex === 'O'){
            return 'Other';
        }
    }
    public function reservations(){
        return $this->hasMany(BookingReservation::class,'user_id');
    }
    public function payment(){
        return $this->hasMany(BookingPayment::class,'user_id')->where('status',1);
    }
}
