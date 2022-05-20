<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //

    protected $guarded = [];

    public function user()
    {
    return $this->belongsTo(User::class,'assigned_by');
    }

    public function artisan()
    {
    return $this->belongsTo(User::class,'assigned_to');
    }
}
