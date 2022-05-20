<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    //
    protected $fillable = [];
    
    public function subscription()
    {
    return $this->hasOne(Subscription::class);
    }
}
