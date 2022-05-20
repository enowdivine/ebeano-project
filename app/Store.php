<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    //
    protected $fillable = [
        'seller_id',
        'name', 
        'slug', 
        'description',
        'address',
        'city', 
        'nearest_bus_stop', 
        'state_id',
        'country_id', 
        'market_id'
    ];
    
    public function seller()
  {
    return $this->belongsTo(Seller::class);
  }
}
