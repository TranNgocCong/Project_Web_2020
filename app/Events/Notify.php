<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Comment;
use App\User;
use App\Post;
use App\Profile;
class Notify implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $owner, $commenter, $link, $avano;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $owner, User $commenter, Post $link, Profile $avano)
    {
        $this->owner = $owner;
        $this->commenter =$commenter;
        $this->link = $link;
        $this->avano = $avano;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['my-channel1'];
    }
  
    public function broadcastAs()
    {
        return 'my-event1';
    }
}