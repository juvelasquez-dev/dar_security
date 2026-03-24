<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProfileUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $message;
    public $timestamp;

    public function __construct($user)
    {
        $this->userId = is_object($user) ? $user->id : $user;
        $this->message = 'Profile updated';
        $this->timestamp = now()->toDateTimeString();
    }

    public function broadcastOn()
    {
        return new PrivateChannel('user.' . $this->userId);
    }

    public function broadcastWith()
    {
        return [
            'userId' => $this->userId,
            'message' => $this->message,
            'timestamp' => $this->timestamp,
        ];
    }

    public function broadcastAs()
    {
        return 'ProfileUpdated';
    }
}
