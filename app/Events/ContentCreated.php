<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Content;
use Log;

class ContentCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $content;
    public $file = "";
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Content $content, $file)
    {

      $this->content = $content;
      $this->file = $file;
      \Log::info('Event ContentCreated lauched!');
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        //return new PrivateChannel('channel-name');
    }
}
