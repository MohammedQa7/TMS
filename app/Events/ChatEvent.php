<?php

namespace App\Events;

use App\Models\Message;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public $chat_id, protected Message $message, protected $user)
    {
        //
    }

    function broadcastWith(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'senderData' => [
                'id' => $this->message->id,
                'userID' => $this->user->id,
                'name' => $this->user->name,
                'profilePhoto' => $this->user->profile_photo_url,
                'message' => $this->message->message,
                'postedAt' => $this->message->created_at->diffForHumans()
            ],
        ];
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('liveChat.' . $this->chat_id),
        ];
    }
}