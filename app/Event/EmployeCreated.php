<?php

namespace App\Event;

use App\Models\Employe;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EmployeCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $employe;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Employe $employe)
    {
        $this->employe = $employe;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
