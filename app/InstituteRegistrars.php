<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstituteRegistrars extends Model
{
    protected $table = 'institute_registrars';
    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    
    public function institute()
    {
        return $this->hasOne(InstituteList::class);
    }
    
    public function forms()
    {
        return $this->hasMany(InstituteForms::class);
    }
}
