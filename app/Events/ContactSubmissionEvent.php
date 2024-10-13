<?php

namespace App\Events;

use App\Models\ContactSubmission;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ContactSubmissionEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public ContactSubmission $submission
    ) {
    }
}
