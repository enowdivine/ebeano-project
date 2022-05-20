<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingCouponMaster extends Model
{
    use SoftDeletes;
    
    protected $table = 'booking_coupon_masters';
    protected $guarded = [];
    
    public function roomType(){
        return $this->belongsToMany(BookingRoomType::class,'coupon_pivot_include_room_type','coupon_id','room_type_id');
    }
    public function paidService(){
        return $this->belongsToMany(BookingPaidService::class,'coupon_pivot_paid_service','coupon_id','paid_service_id');
    }
    public function applied(){
        return $this->hasMany(BookingAppliedCouponCode::class,'coupon_id');
    }
    public function hasCoupon($guest,$amount){
      return  $this->checkCoupon($guest,$amount)['status'];
    }
    public function getMessage($guest,$amount){
      return  $this->checkCoupon($guest,$amount)['message'];
    }
    private function checkCoupon($guest,$amount){
        $response['status'] =  true;
        $response['message'] =  'success';
        if($this->period_start_time > Carbon::now()){
            $response['status'] =  false;
            $response['message'] =  'Code not published yet';
            return $response;
        }
        if($this->period_end_time < Carbon::now()){
            $response['status'] =  false;
            $response['message'] =  'Code expired';
            return $response;
        }
        if($this->min_amount > 0 && $this->min_amount > $amount){
            $response['status'] =  false;
            $response['message'] =  'Amount must be greater than N'.$this->min_amount;
            return $response;
        }
        if($this->max_amount > 0 && $this->max_amount < $amount){

            $response['status'] =  false;
            $response['message'] = 'Amount must be lower than '.$this->max_amount;
            return $response;
        }
        $limit_per_user = $this->limit_per_user > 0?$this->limit_per_user:1;
        if($limit_per_user < $this->applied
                ->where('user_id',$guest)
                ->where('status',1)
                ->count()){

            $response['status'] =  false;
            $response['message'] =  'Limitation expired.';
            return $response;
        }
        if($this->limit_per_coupon > 0 && $this->limit_per_coupon < $this->applied
                ->where('status',1)
                ->count()){
            $response['status'] =  false;
            $response['message'] =  'Limit expired.';
            return $response;
        }
        return $response;
    }
}
