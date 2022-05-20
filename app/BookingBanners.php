<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingBanners extends Model
{
    protected $table = 'booking_banners';
    protected $guarded = [];
    
    public function description()
    {
        return $this->belongsTo(BookingBannersDescription::class);
    }
}
