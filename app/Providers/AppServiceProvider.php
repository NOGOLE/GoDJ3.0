<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;
use Mail;
use App\SongRequest;
use App\Events\SongRequested;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        User::Created(function($user){
          Mail::send('emails.newUser',['user' => $user], function($m) use ($user){
            $m->from(env('MAIL_USERNAME'), 'GoDJ');

            $m->to($user->email, $user->name)->subject('Welcome To GoDJ!');
          });
        });

        SongRequest::Created(function($songRequest){
          event(new SongRequested($songRequest));

        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
