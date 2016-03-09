<?php

namespace App\Listeners;

use App\Events\SongRequested;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SongRequestedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SongRequested  $event
     * @return void
     */
    public function handle(SongRequested $event)
    {
        //
    }
}
