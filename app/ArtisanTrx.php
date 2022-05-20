<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ArtisanTrx extends Model
{
    protected $guarded = ['id'];
    
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    
    public function project()
    {
        return $this->belongsTo('App\ArtisanProject','project_submit');
    }

    public function getCreatedAtColumnAttribute($value)
    {
        return date('d.m.Y h:s A',strtotime($value));
    }
}
