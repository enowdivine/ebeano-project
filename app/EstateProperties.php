<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstateProperties extends Model {

    protected $table = 'estate_properties';
    protected $guarded = [];
    public $timestamps = false;
    
    public function agent()
    {
        return $this->belongsTo('App\User','agent_id');
    }
    
    public function category()
    {
        return $this->belongsTo('App\EstateCategory','category_id');
    }

}
