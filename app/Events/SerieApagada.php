<?php

namespace App\Events;

use App\Models\Serie;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SerieApagada
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $serie;

    public function __construct($serie)
    {
        $this->serie = $serie;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
