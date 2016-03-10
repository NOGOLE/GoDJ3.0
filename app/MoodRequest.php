<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MoodRequest extends Model
{
  //
  protected $fillable = [
    'user_id',
    'title',
    'lat',
    'long',
  ];

  public function user(){
    return $this->belongsTo('App\User');
  }
}
