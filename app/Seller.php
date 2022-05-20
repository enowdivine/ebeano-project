<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    //
    protected $fillable = [
        'user_id',
        'ref_method',
        'referral_code', 
        'verification_info', 
        'bank_name',
        'bank_acc_name', 
        'bank_acc_no',
        'registered_by' 
    ];

    public function user()
    {
    return $this->belongsTo(User::class);
    }

    public function role()
    {
    return $this->belongsTo(Role::class);
    }
    
    public function store(){
  	return $this->hasOne(Store::class);
    }
}
