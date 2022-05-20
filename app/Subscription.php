<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    //
    //protected $fillable = [];
    protected $table = 'subscriptions';
    protected $guarded = [];
    
    public function subscription_plan()
    {
    return $this->belongsTo(SubscriptionPlan::class);
    }
    
    public function user()
    {
    return $this->belongsTo(User::class);
    }
}
// 6F64A7ED5BBEF390B0