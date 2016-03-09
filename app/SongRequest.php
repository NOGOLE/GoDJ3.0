<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SongRequest extends Model
{
    //
    protected $fillable = [
      'user_id',
      'title',
      'artist',
      'lat',
      'long',
    ];

    public function user(){
      return $this->belongsTo('App\User');
    }
}
