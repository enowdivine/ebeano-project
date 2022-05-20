<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstituteList extends Model
{
    protected $table = 'institute_list';
    protected $guarded = [];
    
    
    public function registrar()
    {
        return $this->belongsTo('App\InstituteRegistrars','registrar_id');
    }
    
    public function forms()
    {
        return $this->hasMany('App\InstituteForms','institute_id');
    }
}
