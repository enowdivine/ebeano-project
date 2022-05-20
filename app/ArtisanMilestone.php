<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Milestone extends Model
{
    use SoftDeletes;
    protected $table = "milestones";

    protected  $guarded = [];

    public function assignJob()
    {
        return $this->belongsTo('App\AssignJob','assign_job_id');
    }

    public function project()
    {
        return $this->belongsTo('App\Project','project_id');
    }

    public function author()
    {
        return $this->belongsTo('App\User','author_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function reports()
    {
        return $this->hasMany('App\Report','milestone_id');
    }



}
