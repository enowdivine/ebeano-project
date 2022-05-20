<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArtisanProject extends Model
{
    use SoftDeletes;

    protected $table = "artisan_projects";

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo('App\ArtisanCategory','category_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function bids()
    {
        return $this->hasMany('App\ArtisanBitJob','project_id');
    }

}
