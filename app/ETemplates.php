<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ETemplates extends Model
{
    protected $table = 'etemplates';
    protected $fillable = array( 'esender','emessage');
}
