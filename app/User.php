<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];

    public function songRequests(){
      return $this->hasMany('App\SongRequest');
    }

    public function moodRequests(){
      return $this->hasMany('App\MoodRequest');
    }

    public function parties(){
      return $this->hasMany('App\Party');
    }

    public function stripeAccount(){
      return $this->hasOne('App\StripeAccount');
    }
}
