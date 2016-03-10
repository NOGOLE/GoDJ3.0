<?php

namespace App\Listeners;

use App\Events\MoodRequested;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MoodRequestedListener
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
     * @param  MoodRequested  $event
     * @return void
     */
    public function handle(MoodRequested $event)
    {
        //
    }
}
