<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    //
    protected $fillable = [
        'name', 'permissions', 
    ];

    public function setPermissionsAttribute($value)
    {
        $this->attributes['permissions'] = json_encode($value);
    }

    // public function getPermissionsAttribute($value)
    // {
    //     return $this->attributes['permissions'] = json_decode($value);
    // }
    public function staff()
    {
    return $this->hasOne(Staff::class);
    }
}
