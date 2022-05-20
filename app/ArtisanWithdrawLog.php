<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtisanWithdrawLog extends Model
{
    protected $table = 'artisan_withdraw_logs';

    protected $guarded = [];


    public function artisan()
    {
        return $this->belongsTo(Artisans::class,'user_id')->withDefault();
    }

}
