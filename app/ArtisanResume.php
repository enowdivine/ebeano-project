<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtisanResume extends Model
{
    protected $table ="artisan_resumes";
    protected  $guarded =[];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

}
