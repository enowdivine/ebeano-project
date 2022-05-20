<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artisans extends Model
{
    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    
    public function category()
    {
        return $this->belongsTo('App\ArtisanCategory','category_id');
    }
}
