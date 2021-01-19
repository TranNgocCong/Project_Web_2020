<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Comment;
use App\User;
use App\Profile;
use App\Post;
class NotifyCommentEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $owner, $commenter, $img, $cmtpost;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $owner, User $commenter, Profile $img, Post $cmtpost)
    {
        $this->owner = $owner;
        $this->commenter =$commenter;
        $this->img = $img;
        $this->cmtpost = $cmtpost;
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
