<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $username;
    public $senderId;
    public $recipientId;
    // public $message;
    public $time;
    public $imageUrl; // เพิ่มตัวแปรสำหรับ URL รูปภาพ
    public $timestamp;


    public $recipientUsername;

    public function __construct($username, $senderId, $recipientId, $recipientUsername, $message, $time)
    {
        $this->username = $username;
        $this->message = $message;
        $this->senderId = $senderId;
        $this->recipientId = $recipientId;
        $this->recipientUsername = $recipientUsername; // เพิ่มตัวแปรนี้
        $this->time = $time;
    }

    public function broadcastOn()
    {
        return [
            new Channel('chat'),
        ];
    }

    public function broadcastAs()
    {
        return  'message';
    }
}
