<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
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
