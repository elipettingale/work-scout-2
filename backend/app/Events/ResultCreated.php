<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Result;
use App\Transformers\Result as ResultTransformer;

class ResultCreated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $result;

    public function __construct(Result $result)
    {
        $this->result = $result;
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->result->id
        ];
    }

    public function broadcastWhen()
    {
        return env('WEBSOCKET_ENABLED');
    }

    public function broadcastOn()
    {
        return new Channel('results');
    }
}
