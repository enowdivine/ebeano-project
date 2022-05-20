<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtisanBitJob extends Model
{
    protected $table = "bit_jobs";
    protected $guarded = [];
    
    public function artisans()
    {
        return $this->belongsTo(Artisans::class);
    }
    public function author()
    {
        return $this->belongsTo('App\Artisans','author_id');
    }

    public function project()
    {
        return $this->belongsTo('App\ArtisanProject','project_id');
    }

}
