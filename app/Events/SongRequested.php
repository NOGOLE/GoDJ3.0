<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\SongRequest;

class SongRequested extends Event
{
    use SerializesModels;
    use ShouldBroadcast;
    public $songRequest;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(SongRequest $songRequest)
    {
        //
        $this->songRequest = $songRequest;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['user.'.$this->songRequest->user->id];
    }
}
