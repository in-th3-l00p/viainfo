<?php

namespace App\Events;

use App\Models\Contact\ContactSubmission;
use Illuminate\Broadcasting\InteractsWithSockets;
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
