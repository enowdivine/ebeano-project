<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingSpecialPrice extends Model
{
    protected $table = 'booking_special_prices';
    protected $guarded = [];
    
    public function getDayByRegularPrice($day){
        $day_col ='day_'.$day;
        $amount_col =$day_col.'_amount';
        return [
            'amount_type'=>$this->$day_col,
            'amount'=>$this->$amount_col

        ];
    }
}
