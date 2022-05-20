<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class KYCVerification extends Model
{
    protected $table = "kyc_verifications";
    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    
    public function getCreatedAtColumnAttribute($value)
    {
        return date('d.m.Y h:s A',strtotime($value));
    }
}
