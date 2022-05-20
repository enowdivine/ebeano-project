<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstituteSoldForms extends Model
{
    protected $table = 'institute_sold_forms';
    protected $guarded = [];
    
    public function institute()
    {
        return $this->belongsTo('App\InstituteList','institute_id');
    }
    
    public function form()
    {
        return $this->hasOne('App\InstituteForms','reference');
    }
}
