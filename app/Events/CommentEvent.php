<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Comment;
use App\User;
class CommentEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $data, $username;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Comment $data, User $username)
    {
        $this->data = $data;
        $this->username =$username;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['my-channel'];
    }
  
    public function broadcastAs()
    {
        return 'my-event';
    }
}
