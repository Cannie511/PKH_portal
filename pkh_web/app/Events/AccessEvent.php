<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class AccessEvent extends Event
{
    use SerializesModels;

    /**
     * @var mixed
     */
    public $userId;
    /**
     * @var mixed
     */
    public $ip;
    /**
     * @var mixed
     */
    public $eventName;
    /**
     * @var mixed
     */
    public $notes;
    /**
     * @var mixed
     */
    public $agent;
    /**
     * @var mixed
     */
    public $email;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        $userId,
        $ip,
        $agent,
        $eventName,
        $notes,
        $email
    ) {
        $this->userId    = $userId;
        $this->ip        = $ip;
        $this->eventName = $eventName;
        $this->notes     = $notes;
        $this->agent     = $agent;
        $this->email     = $email;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
