<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;
use Mail;
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
