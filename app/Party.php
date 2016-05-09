<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    //
    protected $guarded = [];
    protected $dates = ['starts_at', 'ends_at', 'created_at', 'updated_at'];
}
