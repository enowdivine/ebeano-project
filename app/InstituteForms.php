<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstituteForms extends Model
{
    protected $table = 'institute_forms';
    protected $guarded = [];
    
    public function institute()
    {
        return $this->belongsTo('App\InstituteList','institute_id');
    }
    
    public function registrar()
    {
        return $this->belongsTo('App\InstituteRegistrars','registrar_id');
    }
}
