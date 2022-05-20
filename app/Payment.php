<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    //protected $fillable = [];
    protected $table = 'payments';
    protected $guarded = [];
    
    public function user()
    {
    return $this->belongsTo(User::class);
    }
}
